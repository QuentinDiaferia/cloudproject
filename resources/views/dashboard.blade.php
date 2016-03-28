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
    	<div class="col-lg-12">
    		<h3>Select a group or create a new one in the menu to get started !</h3>
    	</div>
    </div>
@stop