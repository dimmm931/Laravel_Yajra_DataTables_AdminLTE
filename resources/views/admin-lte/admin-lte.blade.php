<?php
//Admin LTE main page. Contains Users Count BOX, Users DataTables(without CRUD), Students (i.e {abz_employees}) DataTable(with CRUD)
?>

@extends('adminlte::page')
<!-- CSFR meta token --> 
<meta name="_token" content="{{ csrf_token() }}"/>

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to admin panel.</p>
	
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
                <a href="user-lists" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!--- End Users Count BOX-->
  
  
  
    <!--- Users DataTables, $users passed from Controller, + additionally initiated in JS (in this view) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif     
                </div>
                
                <div class="box-body">
		            <hr><h4>Table {users} via Datatables </h4><hr>
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
    <!-- End Users DataTables, $users passed from Controller, + additionally initiated in JS (in this view) -->
  
  
    <!----------------- Yajra /models/Abz/Abz_Employees  ----------------->
    <div class="container"> 
        <br/>
        <br/>
        <div class="table-responsive">
            <hr>
            <h5>Yajra DataTable <span class="small">(on /models/Abz/Abz_Employees)</h5>
    
            <div align="right">
                <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
            </div>
            <br/>
    
            <table id="user_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
			        <th>Dob</th>
			        <th>Phone</th>
			        <th>Nick</th>
			        <th>Super(hO)</th>
			        <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!----------------- Yajra /models/Abz/Abz_Employees  ----------------->
   
    <!------------- Hidden modal with form to create/edit a record ------------>
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Record</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
		            <img src="images/loader.gif" id="emplyee_photo" alt='image'/> <!-- Photo -->
		 
                    <form id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        <!-- @csrf --> <!-- is set in ajax set-up -->
		  
                        <div class="form-group">
                            <label class="control-label col-md-4" >Name : </label>
                            <div class="col-md-8">
                                <input type="text" name="first_name" id="first_name" class="form-control" />
                            </div>
                        </div>
		   
                        <div class="form-group">
                            <label class="control-label col-md-4">Email : </label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control" />
                            </div>
                        </div>
		   
		                <div class="form-group">
                            <label class="control-label col-md-4">Dob: </label>
                            <div class="col-md-8">
                                <input type="date" name="user_dob" id="user_dob" class="form-control" />
                            </div>
                        </div>
		   
		                <div class="form-group">
                            <label class="control-label col-md-4">Phone: </label>
                            <div class="col-md-8">
                                <input type="text" name="user_phone" id="user_phone" class="form-control" />
                            </div>
                        </div>
		   
		                <div class="form-group">
                            <label class="control-label col-md-4">Username: </label>
                            <div class="col-md-8">
                                <input type="text" name="user_n" id="user_n" class="form-control" />
                            </div>
                        </div>
		   
		                <div class="form-group">
                            <label class="control-label col-md-4">Salary: </label>
                            <div class="col-md-8">
                                <input type="text" name="user_salary" id="user_salary" class="form-control" />
                            </div>
                        </div>
		   
		                <!-- Ranks input, dropdown -->
		                <div class="form-group">
                            <label class="control-label col-md-4">Rank: </label>
                            <div class="col-md-8">
			                    <input type="text" name="user_rank_name" id="user_rank_name" class="form-control" /> <!-- visible with Name -->
                                <input type="text" name="user_rank" id="user_rank" class="form-control" /> <!-- hidden with ID -->
                   
				                <select class="mdb-select md-form" id="dropdownRank">
						            <option value="" id="startRank" selected="selected">Change Rank </option>
		                            @foreach ($ranks as $a)
						                <option value={{ $a->id}} > {{ $a->rank_name}} </option>
					                @endforeach
					            </select> 
			                </div>
                        </div>
		                <!-- End Ranks input, dropdown -->
		   
		                <!-- Superior input, dropdown with hasOne relation -->
		                <div class="form-group">
                            <label class="control-label col-md-4">Superior: </label>
                            <div class="col-md-8">
                                <input type="text" name="user_superior_name" id="user_superior_name" class="form-control" /> <!-- visible Name -->
				                <input type="text" name="user_superior" id="user_superior" class="form-control" /> <!-- hidden with ID -->

				                <select class="mdb-select md-form" id="dropdownnn">
						            <option value="" id="start" selected="selected">Change superior </option>
		                            @foreach ($employees as $a)
						                <option value={{ $a->id}} > {{ $a->name}} </option>
					                @endforeach
					            </select> 
                            </div>
                        </div>
		                <!-- End Superior input, dropdown with hasOne relation -->
		   
		   
		                <div class="form-group">
                            <label class="control-label col-md-4">Hired at: </label>
                            <div class="col-md-8">
                                <input type="date" name="user_hired_at" id="user_hired_at" class="form-control" />
                            </div>
                        </div>
		   
		                <div class="form-group">
                            <label class="control-label col-md-4">Image: </label>
                            <div class="col-md-8"> 
                                <input type="file" name="image" id="image" class="form-control" /> <span class="text-danger" id="imgRequired"></span>
                            </div>
                        </div>
		   
                        <br/>
                        <div class="form-group" align="center">
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!------------- END Hidden modal with form to create/edit a record ------------>



    <!----------- Hidden modal window for Deloete confirmation ----------->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Confirmation</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
   
@stop

@section('js')

<!-- Styles -->
<link href="{{ asset('css/my_css.css') }}" rel="stylesheet">

<!-- Sweet Alerts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> <!-- Sweet Alert CSS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <!--Sweet Alert JS-->
 
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready( function () {
	    //users Table DataTable JS init (without ajax, data is passed in Controller -> function adminlte()) => $users = User::all()
        $('#laravel_datatable').DataTable();
    });
    //END Sudents JS
  
  
  
  
    //Yajra /models/Abz/Abz_Employees
   /*
    |--------------------------------------------------------------------------
    | Builds/loads datatables on page load
    |--------------------------------------------------------------------------
    |
    |
    */
    
    var user_id;
    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('/adminlte') }}", //route('sample.index')
        },
        columns: [
            { data: 'name', name: 'name'},
            { data: 'email', name: 'email' },
            { data: 'dob', name: 'dob' },
            { data: 'phone', name: 'phone' },
            { data: 'username', name: 'usernameAnyName' },
            { data: 'get_superior.name', name: 'superior_id' }, //hasOne relation, models/Abz_Employees method getSuperior(), sql column 'name' Displays Superior name. 
                                                       //Same implementation as hasOne relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
   
            //image column
            { data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
			        if (data){ //if image DOES exist in DB
                        return "<img src=\"images/employees/" + data + "\" height=\"50\"/>";
				    } else { //if image is NULL
				        return "<img src=\"images/no-image-found.png\" height=\"50\"/>";
				    }
                }
            },
   
            { data: 'action', name: 'action',orderable: false } //delete/edit column
        ]
    });


   /*
    |--------------------------------------------------------------------------
    | user clicks "Create" and it will show a Modal with Form
    |--------------------------------------------------------------------------
    |
    |
    */
    $('#create_record').click(function(){
        $('.modal-title').text('Add New Record');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#form_result').html('');
        $("#emplyee_photo").attr("src", "images/loader.gif"); //setting the image to loader, if photo there was prev (e.g while editing)
        setTimeout(function(){  
            $("#emplyee_photo").attr("src", "images/profile.png"); //setting the image to loader, if photo there was prev (e.g while editing)
        }, 1000);

        $("#sample_form").trigger('reset')//clears any prev inputs;
	    $('#imgRequired').html('image is required for create');
        $('#formModal').modal('show');
    });







   /*
    |--------------------------------------------------------------------------
    | when user clicks "Submit" button, wether click "Create new" or "Edit" buttons
    |--------------------------------------------------------------------------
    |
    |
    */
    $('#sample_form').on('submit', function(event){
        event.preventDefault();
        var thatX = this;
	
	    //Sweet alert confirm
	    swal({
	        html:true,
            title: "Are you sure you want <i>to proceed</i> ?",
            text: "Want to go ahead?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, go ahead!',
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: true,
            closeOnCancel: false
        },
        function(isConfirm){
            if (!isConfirm){
			    swal({ html:true, title:'Cancelled!', text:'You cancelled <b> the action </b>....</br>  ', type: 'error'});
                return false;
            } else {
                var action_url    = '';
                //var action_method = '';
                var formData = new FormData(thatX); //fix to load image via ajax, serialize() wont't work
            
                if($('#action').val() == 'Add') {
                    action_url = "{{ route('sample.store') }}";
                }

                if($('#action').val() == 'Edit'){
                    action_url = "{{ route('sample.update') }}"; 
                    formData. append("_method", "PUT"); //fix for PUT method
		            swal("!", "Starting editting....", "success");
                }

                //preapare CSRF token for ajax DELETE  
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                }); 
    
                $.ajax({
                    url: action_url,
                    method: "POST",//action_method,//"POST",
                    data: formData, //$(this).serialize(), //fix to load image via ajax, serialize() wont't work
                    dataType:"json",
		            cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        var html = '';
                        
                        if (data.errors) { //array element {errors} is set in YajraDataTablesCrudController
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
				            $(".modal-title").stop().fadeOut("slow",function(){ $(this).html("<h5 style='color:red;padding:3em;'><i class='fa fa-balance-scale' style='font-size:48px;color:red'></i>Error!!! <br> Failed Saving/Editing(S)</h5>")}).fadeIn(2000);
                        }
                        
                        if(data.success) { //array element {success} is set in YajraDataTablesCrudController
                            //alert(data.success);
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
				            $(".modal-title").html('Successfully done');
						    swal({ html:true, title:'Successfully done!', text: data.success, type: 'success'});
                        }
                        $('#form_result').html(html);
			            $('#formModal').animate({ scrollTop: 0 }, 'slow'); //scroll modal to top
			
			 
                    },
		            error: function (error) { //is a must part
			            console.log(error); 
                        $('#formModal').animate({ scrollTop: 0 }, 'slow'); //scroll modal to top
                        $(".modal-title").stop().fadeOut("slow",function(){ $(this).html("<h5 style='color:red;padding:3em;'>ERROR!!! <br> Failed Saving/Editing</h5>")}).fadeIn(2000);
                        //$("html, body").animate({ scrollTop: 0 }, "slow");	 //scroll
                     
		            }	
		 
                });
	 
	 	    } //end else
        });
    });



   /*
    |--------------------------------------------------------------------------
    | When clicks 'Edit', it will open modal with Form and Fill in edit form with values from DB, when u click Edit
    |--------------------------------------------------------------------------
    |
    |
    */
    $(document).on('click', '.edit', function(){ 
        $('#formModal').modal('show'); //show modal
	    //clear the fields if were set prev
	    $('#first_name')     .val("");
        $('#email')          .val("");
	    $('#user_dob')       .val("");
	    $('#user_phone')     .val("");
	    $('#user_n')         .val("");
	    $('#user_salary')    .val(""); 
	    $('#user_rank')      .val("");  
	    $('#user_superior')  .val("");  
	    $('#user_hired_at')  .val(""); 
	    $('#start').val('').prop('selected', true);     //resets Superior <select> input
	    $('#startRank').val('').prop('selected', true); //resets rank <select> input
	 
        $("#emplyee_photo").attr("src", "images/loader.gif"); //changing the image to loader
        $('#imgRequired').html('image is not required for edit');

        var id = $(this).attr('id');
        $('#form_result').html('');
  
        $.ajax({
            url :  "{{ url('/sample/edit/')}}" + "/" + id,    //"/sample/edit" +id,
            dataType:"json",
            success:function(data){  
	            //Fill in ther Edit form value from DB
                $('#first_name')   .val(data.result.name);
                $('#email')        .val(data.result.email);
	            $('#user_dob')     .val(data.result.dob);
	            $('#user_phone')   .val(data.result.phone);
	            $('#user_n')       .val(data.result.username);
			    $('#user_salary')  .val(data.result.salary);
			    $('#user_hired_at').val(data.result.hired_at);
			 
			    //Rank fields (visible with name and hidden with ID, ID goes to server to create/update)
			    $('#user_rank_name')    .val(data.result.get_rank.rank_name); //Name //hasOne relation, models/Abz_Employees method getRank(), sql column 'rank_name'. Displays Rank. Same implementation as hasOne relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
			    $('#user_rank')         .val(data.result.rank_id); //ID
			 
			    //superior fields (visible with name and hidden with ID, ID goes to server to create/update)
			    $('#user_superior_name').val(data.result.get_superior.name);//Name //hasOne relation, models/Abz_Employees method getSuperior(), sql column 'name' Displays Superior name. 
			    $('#user_superior')     .val(data.result.superior_id); //ID
			 
			    $("#emplyee_photo").attr("src", "images/employees/" + data.result.image); //setting displaying the image in the top of form
	            //$('#image').val('pp.img');
	       
                $('#hidden_id').val(id);
                $('.modal-title').text('Edit Record');
                $('#action_button').val('Edit');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            },
   
            error: function (error) {
                $(".modal-title").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> Failed to fill the form</h4>")}).fadeIn(2000);
            }	
        })
    });



   /*
    |--------------------------------------------------------------------------
    | When user clicks "Delete"
    |--------------------------------------------------------------------------
    |
    |
    */
    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
	    $('#ok_button').html('OK');               //normalize button if we deleted smth prev
	    $('#ok_button').prop('disabled', false); //normalize button (make active) if we deleted smth prev
    });

    //Deleting after confirm
    $('#ok_button').click(function(){
        //preapare CSRF token for ajax DELETE  
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            url:"sample/destroy/"+user_id,
            type: 'DELETE',
            beforeSend:function(){
                $('#ok_button').html('<img style="width:2em" src="images/loader.gif"/> Deleting and reassigning...');
			    $('#ok_button').prop('disabled', true); //disable the button
            },
            success:function(data) {   
		        console.log(data);
			    if(data = 204){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();
				        $('#ok_button').html('Deleted OK');
				        $('#ok_button').prop('disabled', false); //normalize button (make active) 
				        swal("!", "Data Deleted successfully. Subordinates are reasigned to a new superior", "success");
                    }, 2000);
                } else {
                    swal("!", "Deleting crashed", "warning");
                }
            },
         
            error: function (error) {
                swal("!", "Error while deleting", "warning");
            },	
        })
    });



    /*
    |--------------------------------------------------------------------------
    | When user changes Superior in dropdown <select><option> (in Edit/Create form)
    | --------------------------------------------------------------------------
    |
    |
    */                                                                                
	if(document.getElementById("dropdownnn") !== null){ //additional check to avoid errors in console in actions, other than actionShowAllBlogs(), when this id does not exist
	    document.getElementById("dropdownnn").onchange = function() {
            //if (this.selectedIndex!==0) {
            //window.location.href = this.value;
			$('#user_superior')     .val(this.value); //set the ID to hidden input
			var selectedText =  $("#dropdownnn option:selected").html(); //gets the text of selected option
			$('#user_superior_name').val(selectedText);  //sets the name to visible input
			  
			//sets the selected to start, sets Superior dropdown selected to initial value = "change"
			$('#start').val('').prop('selected', true);
            //}        
        };
	}   
	   
	   
   /*
    |--------------------------------------------------------------------------
    | When user changes Rank in dropdown <select><option> (in Edit/Create form)
    |--------------------------------------------------------------------------
    |
    |
    */                                                                                
	if(document.getElementById("dropdownRank") !== null){ //additional check to avoid errors in console in actions, other than actionShowAllBlogs(), when this id does not exist
	    document.getElementById("dropdownRank").onchange = function() {
            //if (this.selectedIndex!==0) {
            //window.location.href = this.value;
	        $('#user_rank').val(this.value); //set the ID to hidden input
	        var selectedText =  $("#dropdownRank option:selected").html(); //gets the text of selected option
	        $('#user_rank_name').val(selectedText);  //sets the name to visible input
			  
	        //sets the selected to start, sets Rank dropdown selected to initial value = "change"
	        $('#startRank').val('').prop('selected', true);
            //}        
        };
	}
  
</script>
@stop 