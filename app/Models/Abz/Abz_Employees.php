<?php

namespace App\Models\Abz;

//use Illuminate\Database\Eloquent\Factories\HasFactory;  //causes Crash, not found
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; //for in: validation
use App\Models\Abz\Abz_Ranks;
use Image; //Intervention

class Abz_Employees extends Model
{
	protected $table = 'abz_employees'; //specify the DB table table	
	
	//mass assignment, specify the fields to be edited/created, if u miss the field, the will SQL error, like "No deafault value" 
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'dob',
		'rank_id', 'superior_id', 'salary', 'hired_at', 'image',
    ]; 

    /**
     * belongsTo Relation (the inverse of a hasOne)
     * @return BelongsTo
     *
     */
    public function getRank() //belongsTo Relation (the inverse of a hasOne). Same implementation as hasOne(belongsTo) relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
    {
        return $this->belongsTo('App\Models\Abz\Abz_Ranks', 'rank_id', 'id');   //'foreign_key', 'owner_key' i.e 'parent_id_this_table', 'foreign_key_that_table'
	}




    /**
     * belongsTo Relation (the inverse of a hasOne) //hasOne Relation
     * @return BelongsTo
     * 
     */
     public function getSuperior() //belongsTo Relation //hasOne Relation. Same implementation as hasOne relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
    {
        return $this->belongsTo('App\Models\Abz\Abz_Employees', 'superior_id', 'id')->withDefault(['name' => 'Not set']);
	}	
	
	
	
	
	/**
     * reassign a superior. Upon deleting this employee, find this employee subordinates (whose who has this deleted emplyee's ID as in their 'superior_id' column and assign them other superior with the same rank)
     *
     * @param object $data
     * @return array
     */
	function reassignSuperior($data){
		$delRank    = $data->rank_id; //deleted user rank
		$delUser_ID = $data->id;
		
		//find all deleted user' subordinates
		$subordinates        = $this->where('superior_id', $delUser_ID)->get();
        $reassingedSuperiors = $this->where('rank_id', $delRank)->get(); //find users that has same rank as deleted user and can substitute him
	    
        
        if(!$reassingedSuperiors){
            $reassingedSuperiors = $this->where('rank_id', ($delRank + 1))->get(); //find users that has same rank as deleted user and can substitute him
        } 
		
		//start reasigning each subordinate with a new Superior
        $b = array();
		foreach($subordinates as $v){
            $random = mt_rand(0, ($reassingedSuperiors->count()-1));
			$this->where('id', $v->id)->update([ 'superior_id' => $reassingedSuperiors[$random]->id ]);	//find each user by ID from $subordinates list and update their 'superior_id' with a person from $reassingedSuperiors list
		    array_push($b, $reassingedSuperiors[$random]->id);
        }
		//return $reassingedSuperiors[0]->name;
        return $b;
	}
    
    
	/**
     * New record Store/create validation via model
     * @param $request
     * @return object
     *
     */
	function validateStoreRequest($request)
    {
        $RegExp_Phone = '/^[+]380[\d]{8,12}[0-9]+$/'; //phone regexp
       
        //getting all existing categories from DB {shop_categories}, get from DB only column "id". Used for validation in range {Rule::in(['admin', 'owner']) ]}, ['13', '17']
		$existingRanks = Abz_Ranks::select('id')->get(); 
		$rankList  = array(); // array to contain all roles id  from DB in format ['13', '17']
		foreach($existingRanks as $n){
			array_push($rankList, $n->id);	
		}
		
		$rules = [
			'first_name'  => ['required', 'string', 'min:3'], 
			'email'       => ['required', 'email', 'min:3', 'unique:abz_employees,email'], 
			'user_dob'    => ['required', 'date'], //date validation
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric'], //numeric to accept float
            'user_rank'   => ['required', 'integer', Rule::in($rankList) ] , //in range];
			'user_superior'   => ['required', 'integer', ],
			'user_hired_at'   => ['required', 'date'], //date validation
			'image'           => ['required',  'mimes:png,jpg', 'max:5120' ], //2mb = 2048 //'mimes:jpeg,png,jpg,gif,svg'
			
		];
        
        $messages = [
            'first_name.min'  => 'First name at least 3 chars',
            'user_phone.regex'   => 'Phone must be in format +380....',
        ];

        $result =  Validator::make($request, $rules, $messages);
		//$validator = Validator::make($request->all(), $rules );
        return $result;
    }
    
    
     
	/**
     * Entity Updating/editing validation via model
     * @param $request
     * @return object
     *
     */
	function validateUpdateRequest($request)
    {
        $RegExp_Phone = '/^[+]380[\d]{8,12}[0-9]+$/'; //phone regexp
		
        //getting all existing categories from DB {shop_categories}, get from DB only column "id". Used for validation in range {Rule::in(['admin', 'owner']) ]}, ['13', '17']
		$existingRanks = Abz_Ranks::select('id')->get(); 
		$rankList  = array(); // array to contain all roles id  from DB in format ['13', '17']
		foreach($existingRanks as $n){
			array_push($rankList, $n->id);	
		}
        
		$rules = [
			'first_name'  => ['required', 'string', 'min:3', 'max:252'], 
			'email'       => ['required', 'email'], 
			'user_dob'    => ['required', 'date'], //date validation
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric', 'between:1, 500.00'], //numeric to accept float
			'user_rank'   => ['required', 'integer', Rule::in($rankList) ] , //in range];
			'user_superior'   => ['required', 'integer', ],
			'user_hired_at'   => ['required', 'date'], //date validation
			//image NOT OBLIGATORY REQUIRED for UPDATE
			'image' => [/*'required',*/  'mimes:png,jpg', 'max:5120' ], //2mb = 2048 //'mimes:jpeg,png,jpg,gif,svg'
			
		];
        
        $messages = [
            'first_name.min'  => 'First name at least 3 chars',
            'user_phone.regex'   => 'Phone must be in format +380....',
        ];

        $result =  Validator::make($request, $rules, $messages);
        return $result;
    }
    
    
    
   /**
     * Intervention Library, resizing image + save, move uploaded image to the specified folder  
     *
     * @param  \Illuminate\Http\Request  $request
     * @return sting
     *
     */
    function interventionResizeSave($request)
    {
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
        return $imageName;
    }
    
    
    
    /**
     * Forming data_array to save in Contrl via ::create
     * @param  \Illuminate\Http\Request  $request
     * @param string $imageName
     * @return array
     *
     */
    function prepareCreateFormData($request, $imageName)
    {
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
        return $form_data;
    }
    
    
    
    /**
     * Forming data_array to update in Contrl via ->create
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     */
    function prepareUpdateFormData($request)
    {
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
        return $form_data;
    }
	
}