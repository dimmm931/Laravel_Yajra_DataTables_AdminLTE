<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abz\Abz_Employees;
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

     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 
    public function adminlte()
    {
		$usersCount = User::count(); // for badge
		$users = User::all(); //for Datatable with users
		
		 //$students = Abz_Employees::all();
		
        return view('admin-lte.admin-lte', [
		       'usersCount' => $usersCount,
			   'users' => $users, 
			   //'students' => $students
			 ]);
    }
	
	
	
    /**
     * Used in public function adminlte(), builds {abz_employees} via Datatables, adds CRUD buttons but they are not eplemented 
	 //in future should be Deleted and replaced with Yajra DataTables
     *
     */
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
			

    }
	
	
	
	
	
	
	
	
	
	
    /**
     * Simple datatables test.
     * Minor (semi-working simple without CRUD)example of datatables, for Core/Major version of DataTables with CRUD see /Controllers/YajraDataTablesCrudController + /views/yajra-data-tables-crud2/data_smaple.php
     * Or see simple without CRUD)example of datatables, see /Controllers/AdminLTEController/public function adminlte()
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin-lte.datatable-test');
    }
	
	
	
	//NOT USED???????
	/**
     * For ajax requests
     *
     * @return 
     */
	public function getStudents(Request $request)
    {
		
        //if ($request->ajax()) {
            $data = Abz_Employees::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        //}
    }
	
	
	
	
	
	
}
