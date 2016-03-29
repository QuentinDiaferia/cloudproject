@extends('layouts.app')

<?php
$group = DB::table('groups')->where('id', $id)->orderBy('name')->first();
?>

@section('title')
    Group {{ $group->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Group directory : {{ $group->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-primary">
            	<div class="panel-heading">
            		File explorer
            	</div>
            	<div class="panel-body">
            		<div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>File name</th>
                                    <th>Size</th>
                                    <th>Last modified</th>
                                    <th width="25%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="fileList">
                                <?php
                                $files = Storage::files($group->name.$group->id);
                                ?>
                                @foreach ($files as $file)
                                <tr>
                                    <td>{{ explode('/', $file)[1] }}</td>
                                    <td>{{ Storage::size($file) }} bytes</td>
                                    <td>{{ date('d/m/y G:i', Storage::lastModified($file)) }}</td>
                                    <td style="text-align:right">
                                        <a href="{{ url('group/'.$group->id.'/download/'.explode('/', $file)[1]) }}" target="_blank">
                                            <button class="btn btn-primary">
                                                <i class="fa fa-download"></i> Download
                                            </button>
                                        </a>
                                        <form method="get" action="{{ url('group/'.$group->id.'/delete/'.explode('/', $file)[1]) }}" style="display:inline">
                                            <button class="btn btn-danger">
                                                <i class="fa fa-times"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form id="dropzone" action="{{ url('group/'.$group->id.'/upload') }}" class="dropzone needsclick" id="demo-upload">
                    </form>
            	</div>
            </div>
        </div>
        <!-- /.col-lg-7 -->

        <div class="col-lg-5">
        	<div class="panel panel-info">
        		<div class="panel-heading">
            		Members
            	</div>
            	<div class="panel-body">
                    @if (isset($success) AND $success)
                        <div class="row">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    Member successfully added !
                                </div>
                            </div>
                        </div>
                    @elseif (isset($success) AND !$success)
                        <div class="row">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    An error occured !
                                </div>
                            </div>
                        </div>
                    @endif
                    <?php
                    $members = DB::table('users')->select('users.name as name')->join('groups', function($join) {
                        $join->on('groups.admin', '=', 'users.id')
                            ->orOn('groups.member1', '=', 'users.id')
                            ->orOn('groups.member2', '=', 'users.id');
                    })->where('groups.id', $group->id)->get();
                    $numberOfMembers = count($members);
                    ?>
                    @foreach ($members as $member)
                        <h3>{{ $member->name }}</h3>
                        <hr />
                    @endforeach
                    @if (Auth::user()->id == $group->admin AND $numberOfMembers < 3)
                        <form class="form-horizontal" method="POST" action="{{ url('group/'.$group->id) }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="groupId" value="{{ $group->id }}" />
                            <div class="form-group{{ $errors->has('member') ? ' has-error' : '' }}">
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="member" value="{{ old('member') }}" placeholder="New member name" required>
                                </div>

                                <button class="btn btn-primary">Add</button>

                                @if ($errors->has('member'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('member') }}</strong>
                                    </span>
                                @endif         
                            </div>
                        </form>
                    @endif
            	</div>
        	</div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Dropzone JavaScript -->
    <script src="{{ url('js/dropzone.js') }}"></script>
    <script>
    Dropzone.options.dropzone = {
        previewTemplate: '<div id="ajax-loader"><img src="{{ url("img/ajax-loader.gif") }}" /></div>',
        init: function() {
            this.on("success", function(file) {
                this.element.classList.remove("dz-started");
                $("#ajax-loader").remove();

                location.reload();
                
            });
        },
        addedfile: function(file) {
            var _results;
            if (this.element === this.previewsContainer) {
                this.element.classList.add("dz-started");
            }
            if (this.previewsContainer) {
                file.previewElement = Dropzone.createElement(this.options.previewTemplate.trim());
                file.previewTemplate = file.previewElement;
                this.previewsContainer.appendChild(file.previewElement);
                return _results;
            }
        }   
    };
    </script>
@stop