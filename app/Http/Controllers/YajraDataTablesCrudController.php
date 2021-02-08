<?php
//https://www.webslesson.info/2019/10/laravel-6-crud-application-using-yajra-datatables-and-ajax.html

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abz\Abz_Employees;
use DataTables;
//use Validator;
use Illuminate\Support\Facades\Validator;



class YajraDataTablesCrudController extends Controller
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
     * Display a listing of the resource (all users in table Abz_Employees).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Abz_Employees::with('getRank', 'getSuperior')->latest()->get();  //->with('getRank', 'getSuperior') => hasOne Relations, models/Abz_Employees methods getSuperior(), getRank() 
            //dd($data);
			return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm my-btn">_Edit_</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm my-btn">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('yajra-data-tables-crud2.sample_data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. Done
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/'; //phone regexp
		
		$rules = [
			'first_name'  => ['required', 'string', 'min:3'], 
			'email'       => ['required', 'email'], 
			'user_dob'    => ['required', 'string'],
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric'], //numeric to accept float
			'user_rank'   => ['required', 'integer', ],
			'user_superior'   => ['required', 'int', ],
			'user_hired_at'   => ['required',],

			//image validation https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
			'image' => ['required',  'mimes:jpeg,png,jpg,gif,svg', 'max:2048' ],
			
		];

        $error =  Validator::make($request->all(), $rules);
		//$validator = Validator::make($request->all(), $rules /*, $mess*/);

        if ($error->fails()) {  //($validator->fails())   //($error->fails())
            return response()->json(['errors' => $error->errors()->all()]);
        }


        //Move uploaded image to the specified folder 
		$imageName = time(). '_' . $request->image->getClientOriginalName(); //new name (time + originalName)
		request()->image->move(public_path('images/employees'), $imageName);
		
		
		
        $form_data = array(
            'name'        =>  $request->first_name, //DB column => input name
            'email'       =>  $request->email,
			'dob'         =>  $request->user_dob,
			'phone'       =>  $request->user_phone,
			'username'    =>  $request->user_n,
			'rank_id'     =>  $request->user_rank,
			'superior_id' =>  $request->user_superior,
			'salary'      =>  $request->user_salary,
			'hired_at'    =>  $request->user_hired_at,
			'image'       =>  $imageName, //$request->image,
        );

        if ( Abz_Employees::create($form_data)) {
            return response()->json(['success' => 'Data Added successfully']);
		} else {
			return response()->json(['success' => 'Failed to add data']);

		}
    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function show(Abz_Employees $sample_data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     */
	 /*
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Abz_Employees::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
    */
	
	
	
    /**
     * Update the specified resource in storage. Done
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request/*, Abz_Employees $sample_data*/)
    {
		
       $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/'; //phone regexp
		
		$rules = [
			'first_name'  => ['required', 'string', 'min:3'], 
			'email'       => ['required', 'email'], 
			'user_dob'    => ['required', 'string'],
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric'], //numeric to accept float
			'user_rank'   => ['required', 'integer', ],
			'user_superior'   => ['required', 'int', ],
			'user_hired_at'   => ['required',],
			//image validation https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
			'image' => ['required',  'mimes:jpeg,png,jpg,gif,svg', 'max:2048' ],
			
		];

        $error =  Validator::make($request->all(), $rules);
		//$validator = Validator::make($request->all(), $rules /*, $mess*/);

        if ($error->fails()) {  //($validator->fails())   //($error->fails())
            return response()->json(['errors' => $error->errors()->all()]);
        }


        //Move uploaded image to the specified folder 
		$imageName = time(). '_' . $request->image->getClientOriginalName(); //new name (time + originalName)
		request()->image->move(public_path('images/employees'), $imageName);
		
		
		//delete a prev image from folder '/images/employees/'
		$product = Abz_Employees::where('id', $request->hidden_id)->first(); //found image 
		if(file_exists(public_path('images/employees/' . $product->image))){
		    \Illuminate\Support\Facades\File::delete('images/employees/' . $product->image);
		}
		
        $form_data = array(
            'name'        =>  $request->first_name, //DB column => input name
            'email'       =>  $request->email,
			'dob'         =>  $request->user_dob,
			'phone'       =>  $request->user_phone,
			'username'    =>  $request->user_n,
			'rank_id'     =>  $request->user_rank,
			'superior_id' =>  $request->user_superior,
			'salary'      =>  $request->user_salary,
			'hired_at'    =>  $request->user_hired_at,
			'image'       =>   $imageName, //$request->image,
        );

        if (Abz_Employees::whereId($request->hidden_id)->update($form_data)) {
            return response()->json(['success' => 'Data is successfully updated']);
		} else {
			return response()->json(['success' => 'Failed to update']);

		}

    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Abz_Employees::findOrFail($id);
        $data->delete();
    }
	
	
	
	
	/**
     * Find 1 record by ID to fill in Edit form with values. for ajax.
     *
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function getFormVal($id)
    {
        $data = Abz_Employees::with('getRank', 'getSuperior')->findOrFail($id); //with('getRank', 'getSuperior') => hasOne Relations, => hasOne Relations, models/Abz_Employees methods getSuperior(), getRank()
        return response()->json(['result' => $data]);
    }
}

