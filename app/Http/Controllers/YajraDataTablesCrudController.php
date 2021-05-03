<?php
//REST API Controller, for create, update, delete
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abz\Abz_Employees;
use App\Models\Abz\Abz_Ranks;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; //for in: validation
//use Image; //Intervention
use App\Http\Requests\StoreAbzRequest;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(request $request)  //StoreAbzRequest $request
    {
        $model = new Abz_Employees();
        
        //Validation via model
        $resultStatus = $model->validateStoreRequest($request->all());
        if ($resultStatus->fails()) {  
            return response()->json(['errors' => $resultStatus->errors()->all()]);
        }
        
        // Intervention Library, resizing image + save, move uploaded image to the specified folder  
        $imageName = $model->interventionResizeSave($request);
       		
        //Forming data_array to save in Contrl via ::create
        $form_data = $model->prepareCreateFormData($request, $imageName);

        if (Abz_Employees::create($form_data)) {
            return response()->json(['success' => 'Data saved successfully']);
		} else {
			return response()->json(['errors' => 'Failed to save data']);
		}
    }





	
    /**
     * Update the specified resource in storage. Done. Image upload is NOT MANDATORY Required.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $model = new Abz_Employees();
        
        //Validation via model
        $resultStatus = $model->validateUpdateRequest($request->all());
        if ($resultStatus->fails()) {  
            return response()->json(['errors' => $resultStatus->errors()->all()]);
        }
        
		if($request->file('image')!= null){
	        // Intervention Library, resizing image + save, move uploaded image to the specified folder  
            $imageName = $model->interventionResizeSave($request);

		    //delete a prev/old image from folder '/images/employees/'
		    $product = Abz_Employees::where('id', $request->hidden_id)->first(); //found image 
		    if(file_exists(public_path('images/employees/' . $product->image))){
		        \Illuminate\Support\Facades\File::delete('images/employees/' . $product->image);
		    }
        }
		
        //Forming data_array to update in Contrl via ->update
        $form_data = $model->prepareUpdateFormData($request);
        
        		
		//if a user uploaded an image which is NOT OBLIGATORY REQUIRED for Update, then add this image to $form_data 
		if($request->file('image')!= null){
			$form_data['image'] = $imageName;
		}

        if (Abz_Employees::whereId($request->hidden_id)->update($form_data)) {
            return response()->json(['success' => 'Data is successfully updated']);
		} else {
			return response()->json(['errors' => 'Failed to update data']);

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
        $info = $data;
        
        //reassign a new superior to deleted user's subordinates. Upon deleting this employee, find this employee subordinates (whose who has this deleted emplyee's ID as in their 'superior_id' column and assign them other superior with the same rank)
		$model = new Abz_Employees();
		$v = $model->reassignSuperior($info);
        
        //delete the image from folder '/images/employees/'
		//$product = Abz_Employees::where('id', $id)->first(); //found image 
		if(file_exists(public_path('images/employees/' . $data->image))){
		    \Illuminate\Support\Facades\File::delete('images/employees/' . $data->image);
		}
        
		$data->delete(); //delete the user
		
		return response()->json(['result' => $v]);
        //return 204;
    }
	
	
	
	
	/**
     * Find 1 record by ID to fill in Edit form with values. for ajax.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getFormVal($id)
    {
        $data = Abz_Employees::with('getRank', 'getSuperior')->findOrFail($id); //with('getRank', 'getSuperior') => hasOne Relations, => hasOne Relations, models/Abz_Employees methods getSuperior(), getRank()
        return response()->json(['result' => $data]);
    }
    
    
    /**
     * Display the specified resource.
     * @param  \App\Abz_Employees  $sample_data
     * @return \Illuminate\Http\Response
     *
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
	
    
}

