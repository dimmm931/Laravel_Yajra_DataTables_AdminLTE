<?php
//Admin LTE page with users list
?>

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
	<h6 class="mb-4">Laravel-AdminLTE Example  https://github.com/jeroennoten/Laravel-AdminLTE</h6>  
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
	
	<!--- Users Count BOX-->
	<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $users->count() }}</h3>
          <p>Users</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <!--<a href="/user" class="small-box-footer">No More info <i class="fa fa-arrow-circle-right"></i></a>-->
      </div>
    </div>
  </div>
  <!--- End Users Count BOX-->
  
  
  
    <!--- All users list -->
    <div class="row">
        <div class="col-sm-3 col-xs-3 list-group-item bg-primary">
            ID
        </div> 
        <div class="col-sm-3 col-xs-3 list-group-item bg-primary">
            Name
        </div>
        <div class="col-sm-3 col-xs-3 list-group-item bg-primary">
            Email
        </div>
        <div class="col-sm-3 col-xs-3 list-group-item bg-primary">
            Email
        </div>
    </div>
        
    @foreach ($users as $a)
        <div class="row">
            <div class="col-sm-3 col-xs-3 list-group-item bg-success">
                {{ $loop->iteration }}
            </div> 
                
            <div class="col-sm-3 col-xs-3 list-group-item bg-success">                
                {{ $a->name }}
            </div>
                
            <div class="col-sm-3 col-xs-3 list-group-item bg-success">                
                {{ $a->email }}
            </div>
            
            <div class="col-sm-3 col-xs-3 list-group-item bg-success">                
                {{ $a->email }}
            </div>
        </div>    
    @endforeach
 
   
   
@stop

@section('js')

<!--- SOLUTION!!!! MEGA Fix -->

<!--- SOLUTION!!!! MEGA Fix -->

<script>
  
  $(document).ready( function () {
 
</script>
@stop





  
  
