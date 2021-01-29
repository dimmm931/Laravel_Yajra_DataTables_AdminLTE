

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
          <h3>{{ $usersCount }}</h3>
          <p>Users</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <!--- End Users Count BOX-->
  
  
  
  <!--- Users -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
          @endif     
        </div>
        <div class="box-body">
          <table id="laravel_datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>{{ $user->updated_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
   <!-- End Users -->
  
  
  
  <!-- Students via DataTable -->
  <div class="row">
    <div class="col-xs-12">
	  <hr><h4>Table Student via Datatables</h4>
      <div class="box">
        <div class="box-header">
          @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
          @endif     
        </div>
        <div class="box-body">
          <table id="laravel_datatable_2" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Dob</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
   <!-- End Students -->
@stop

@section('js')

<!--- SOLUTION!!!! MEGA Fix -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!--- SOLUTION!!!! MEGA Fix -->

<script>
  
  $(document).ready( function () {
 
	//users Table DataTable JS
    $('#laravel_datatable').DataTable();
	
 
  
  //Students table DataTable JS
  //$(document).ready( function () {
    $('#laravel_datatable_2').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('country-list') }}",
      columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'phone', name: 'phone' },
        { data: 'dob', name: 'dob' },
		
		    
      ]
    });
	
  });
  //END Sudents JS
</script>
@stop





  
  
