<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abz\Abz_Employees;
use App\Models\Abz\Abz_Ranks;
use DataTables;
use App\User;


class AdminLTEController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    
	/**
     * Admin LTE main page. Contains Users Count BOX, Users DataTables(without CRUD), Students (i.e {abz_employees}) DataTable(with CRUD)
     * @param $request
     * @return \Illuminate\Contracts\Support\Renderable|Datatables
     * 
     */
	 
    public function adminlte(Request $request)
    {
        //handles ajax request to build a dataTable
        if($request->ajax()){
            $data = Abz_Employees::with('getRank', 'getSuperior')->latest()->get();  //->with('getRank', 'getSuperior') => hasOne Relations, models/Abz_Employees methods getSuperior(), getRank() 
            //dd($data);
			return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm my-btn">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm my-btn">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
		//End handles ajax request to build a dataTable
		
        //INJECTED
		// For regular http request without ajax
        $usersCount = User::count(); // for badge
		$users      = User::all(); //for Datatable with users
		$employees  = Abz_Employees::with('getRank', 'getSuperior')->latest()->get(); //gets data for superior dropdown
		$ranks      = Abz_Ranks::latest()->get(); //gets data for ranks dropdown
        
        return view('admin-lte.admin-lte', [
		       'usersCount' => $usersCount,
			   'users'      => $users, 
			   'employees'  => $employees,
               'ranks'      => $ranks
			 ]);
    }
	
	
    
    
    
    
    
    
	
    /**
     * Used in public function adminlte(), builds {abz_employees} via Datatables, adds CRUD buttons but they are not eplemented 
	 //in future should be Deleted and replaced with Yajra DataTables
     *
     */
     /*
    public function getList()
    {
        $students = Abz_Employees::select(['id', 'name', 'email', 'phone', 'dob', 'image']);
		
        return Datatables::of($students)
		    //adding columns
		    ->addColumn('action', function($row) {
                return '<a href="/prodicts/'. $row->id .'/edit" class="btn btn-primary">Edit</a>';
            })
            ->editColumn('delete', function ($row) {
                return '<a href="/products/show/1' . $row->id . '">delete</a>';
            })
            ->rawColumns(['delete' => 'delete','action' => 'action'])
			//End adding columns
		    ->make(true);
			

    }*/
	
    
    
    /**
     * View users list
     * @return array of collection
     *
     */
    public function viewUsers()
    {
		$users = User::all(); //for Datatable with users		
        return view('admin-lte.lte_users-view', [
			   'users' => $users, 
			]);
    }
	
}
