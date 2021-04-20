<?php
//https://www.webslesson.info/2019/10/laravel-6-crud-application-using-yajra-datatables-and-ajax.html

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abz\Abz_Employees;
use App\Models\Abz\Abz_Ranks;
use DataTables;
//use Validator;
use Illuminate\Support\Facades\Validator;
use Image; //Intervention


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
    
    //NOT USED IN CLEANSED VERSION
    /*
    public function index(Request $request)
    {
		//handles ajax request to build a dataTable
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
		//End handles ajax request to build a dataTable
		
		// For regulat http request without ajax
		$employees = Abz_Employees::with('getRank', 'getSuperior')->latest()->get(); //gets data for superior dropdown
		$ranks     = Abz_Ranks::latest()->get(); //gets data for ranks dropdown
		
        return view('yajra-data-tables-crud2.sample_data',  compact('employees', 'ranks'));
    }
    */

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
     * Store a newly created resource in storage. Done. Image upload is Required.
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
			'user_dob'    => ['required', 'date'], //date validation
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric'], //numeric to accept float
			'user_rank'   => ['required', 'integer', ],
			'user_superior'   => ['required', 'integer', ],
			'user_hired_at'   => ['required', 'date'], //date validation
			//image validation https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
			'image' => ['required',  'mimes:png,jpg', 'max:5120' ], //2mb = 2048 //'mimes:jpeg,png,jpg,gif,svg'
			
		];

        $error =  Validator::make($request->all(), $rules);
		//$validator = Validator::make($request->all(), $rules /*, $mess*/);

        if ($error->fails()) {  //($validator->fails())   //($error->fails())
            return response()->json(['errors' => $error->errors()->all()]);
        }

        
		//------------------------------------------------------------------
		//Intervention Lib, resizing image + save ----- //https://stackoverflow.com/questions/59300544/how-to-reduce-size-of-image-in-laravel-when-upload
	    if($request->file('image') != null){ //
		    $image = $request->file('image'); //uploded image 
		    $imageName = time(). '_' . $request->image->getClientOriginalName(); //new name (time + originalName). //Prev variant (before implement Intervention resize). Working!!!
            //$input['imagename'] = time().  '_' . $request->image->getClientOriginalName(); // . '.'.$image->getClientOriginalExtension(); //create name: time+name+extension

            $destinationPath = public_path('images/employees');
            $img = Image::make($image->getRealPath());
		
		    //watermark
		    $watermark = Image::make('images/water-mark.png'); //watermark
		    $watermark->resize(20, 20); //watermark resize
		
		    //resize avatar image to (300, 300) + adding watermark + save. Uses method chaining. Alternatively can do separately $img->resize(); $img->insert(); $img-save();
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })
		        ->insert($watermark, 'bottom-right', 10, 10) // insert watermark at bottom-right corner with 10px offset
		        ->save($destinationPath.'/' . $imageName); //save
        }

           //$destinationPath = public_path('images/employees');
           //$image->move($destinationPath, $imageName);
	   
	   //END Intervention Lib, resizing image + save  -----
	   //------------------------------------------------------------------
	   
        //Move uploaded image to the specified folder 
		//request()->image->move(public_path('images/employees'), $imageName); //Prev variant (before implement Intervention resize). Working!!!
		
		
		
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
     * Update the specified resource in storage. Done. Image upload is NOT MANDATORY Required.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request/*, Abz_Employees $sample_data*/)
    {
		
       $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/'; //phone regexp
		
		$rules = [
			'first_name'  => ['required', 'string', 'min:3', 'max:252'], 
			'email'       => ['required', 'email'], 
			'user_dob'    => ['required', 'date'], //date validation
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric', 'between:1, 500.00'], //numeric to accept float
			'user_rank'   => ['required', 'integer', ],
			'user_superior'   => ['required', 'integer', ],
			'user_hired_at'   => ['required', 'date'], //date validation
			//image validation https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
			//image NOT OBLIGATORY REQUIRED for UPDATE
			'image' => [/*'required',*/  'mimes:png,jpg', 'max:5120' ], //2mb = 2048 //'mimes:jpeg,png,jpg,gif,svg'
			
		];

        $error =  Validator::make($request->all(), $rules);
		//$validator = Validator::make($request->all(), $rules /*, $mess*/);

        if ($error->fails()) {  //($validator->fails())   //($error->fails())
            return response()->json(['errors' => $error->errors()->all()]);
        }

        //https://stackoverflow.com/questions/59300544/how-to-reduce-size-of-image-in-laravel-when-upload
        //Move uploaded image to the specified folder 
		
		/*
		// Resize and center image 
		$width = 200;
        $height = 200;

        // тип содержимого
        header('Content-Type: image/jpeg');

       // получение новых размеров
       list($width_orig, $height_orig) = getimagesize($request->image);

       $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
            $width = $height*$ratio_orig;
        } else {
             $height = $width/$ratio_orig;
        }

        //retains the original image's aspect ratio when resizing, and doesn't resize or resample if the original width and height is smaller then the desired resize.          $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($request->image);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);/finalImage, sourceImage
        //rename($image_p, $imageName);	
		// End Resize and center image 
		*/
		
		//------------------------------------------------------------------
		//Intervention Lib, resizing image + save ----- //https://stackoverflow.com/questions/59300544/how-to-reduce-size-of-image-in-laravel-when-upload
	    if($request->file('image') != null){ //if a user uploaded an image which is NOT OBLIGATORY REQUIRED for UPDATE
		    $image = $request->file('image'); //uploded image 
		    $imageName = time(). '_' . $request->image->getClientOriginalName(); //new name (time + originalName). //Prev variant (before implement Intervention resize). Working!!!
            //$input['imagename'] = time().  '_' . $request->image->getClientOriginalName(); // . '.'.$image->getClientOriginalExtension(); //create name: time+name+extension

            $destinationPath = public_path('images/employees');
            $img = Image::make($image->getRealPath());
		
		    //watermark
		    $watermark = Image::make('images/water-mark.png'); //watermark
		    $watermark->resize(20, 20); //watermark resize
		
		    //resize avatar image to (300, 300) + adding watermark + save. Uses method chaining. Alternatively can do separately $img->resize(); $img->insert(); $img-save();
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })
		        ->insert($watermark, 'bottom-right', 10, 10) // insert watermark at bottom-right corner with 10px offset
		        ->save($destinationPath.'/' . $imageName); //save
        }

           //$destinationPath = public_path('images/employees');
           //$image->move($destinationPath, $imageName);
	   
	   //END Intervention Lib, resizing image + save  -----
	   //------------------------------------------------------------------
	   
	   //request()->image->move(public_path('images/employees'), $imageName);  //Prev variant (before implement Intervention resize). Working!!!
		
		





		//delete a prev/old image from folder '/images/employees/'
		$product = Abz_Employees::where('id', $request->hidden_id)->first(); //found image 
		if(file_exists(public_path('images/employees/' . $product->image))){
		    \Illuminate\Support\Facades\File::delete('images/employees/' . $product->image);
		}
		
		//Forming array with data to update
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
			//'image'       =>  $imageName, //$input['imagename'], //$imageName, //$request->image,
        );
		
		//if a user uploaded an image which is NOT OBLIGATORY REQUIRED for Update, then add this image to $form_data 
		if($request->file('image')!= null){
			$form_data['image'] = $imageName;
		}

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
		$data->delete(); //delete the user


		//reassign a new superior to deleted user's subordinates. Upon deleting this employee, find this employee subordinates (whose who has this deleted emplyee's ID as in their 'superior_id' column and assign them other superior with the same rank)
		$model = new Abz_Employees();
		$v = $model->reassignSuperior($data);
		
		//return response()->json(['result' => $v]);

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

