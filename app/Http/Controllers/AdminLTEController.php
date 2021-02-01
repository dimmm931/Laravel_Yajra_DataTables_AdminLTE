<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
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
     * Simple datatables.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin-lte.admin-main-page');
    }
	
	
	/**
     * For ajax requests
     *
     * @return 
     */
	public function getStudents(Request $request)
    {
		
        //if ($request->ajax()) {
            $data = Student::latest()->get();
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
	
	
	
	
	
	 /**
     * Admin LTE.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminlte()
    {
		$usersCount = User::count();
		$users = User::all();
		
		 //$students = Student::all();
		
        return view('admin-lte.admin-lte', [
		       'usersCount' => $usersCount,
			   'users' => $users, 
			   //'students' => $students
			 ]);
    }
	
	
	
	/**
     * Get
     *
     */
    public function getList()
    {
		
        $students = Student::select(['id', 'name', 'email', 'phone', 'dob', 'image']);
		
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
	
	
}
