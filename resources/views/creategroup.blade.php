@extends('layouts.app')

@section('title')
    Create a new group
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create a new group</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @if (isset($success))
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                New group
            </div>
            <div class="panel-body">
                The new group has been successfully created.
            </div>
        </div>
    </div>
    @endif
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <form class="form-horizontal" method="POST" action="{{ url('creategroup') }}">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-lg-4 control-label">Name : </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" autofocus required>
                        </div>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button class="pull-right btn btn-primary">Create</button>
                </div>
            </form>
        </div>
       
    </div>
    <!-- /.row -->
@stop