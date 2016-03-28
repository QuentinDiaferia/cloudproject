@extends('layouts.app')

@section('title')
    Dashboard
@stop

@section('content')
    <?php
    $user = Auth::user();
    ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Welcome, {{ $user->name }} !</h1>
           
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
    	<div class="col-lg-3">
    		<div class="panel panel-primary">
    			<div class="panel-heading">
    				My Groups
    			</div>
    			<div class="panel-body">
    				<div class="panel panel-info">
    					<div class="panel-heading">
    						Group project
    					</div>
    					<div class="panel-body">
    						with Machin Truc and Bidule Chouette<br />
    						3 files
    					</div>
    				</div>

    				<div class="panel panel-info">
    					<div class="panel-heading">
    						Management
    					</div>
    					<div class="panel-body">
    						with Machin Truc and Bidule Chouette<br />
    						3 files
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-3">
    		<div class="panel panel-green">
    			<div class="panel-heading">
    				Last activities
    			</div>
    			<div class="panel-body">
    				Machin Truc added file.txt to <a href="">Group project</a>.<br />
    				<p class="small text-right">16 minutes ago.</p>
    				<hr />
    				Bidule Chouette updated file.txt to <a href="">Management</a>.<br />
    				<p class="small text-right">3 hours ago.</p>
    			</div>
    		</div>
    	</div>
    </div>
@stop