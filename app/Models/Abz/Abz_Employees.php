<?php

namespace App\Models\Abz;

//use Illuminate\Database\Eloquent\Factories\HasFactory;  //causes Crash, not found
use Illuminate\Database\Eloquent\Model;

class Abz_Employees extends Model
{
	protected $table = 'abz_employees'; //specify the DB table table
	
	
    //use HasFactory;
	
	
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
     *  belongsTo Relation (the inverse of a hasOne)
     *
     * @param  
     * @return string
     */
    public function getRank() //belongsTo Relation (the inverse of a hasOne). Same implementation as hasOne(belongsTo) relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
    {
		//return $this->hasOne('App\Models\Abz\Abz_Ranks', 'id', 'rank_id');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
        return $this->belongsTo('App\Models\Abz\Abz_Ranks', 'rank_id', 'id');   //'foreign_key', 'owner_key' i.e 'parent_id_this_table', 'foreign_key_that_table'
	}




    /**
     * belongsTo Relation (the inverse of a hasOne) //hasOne Relation
     *
     * @param  
     * @return string
     */
     public function getSuperior() //belongsTo Relation //hasOne Relation. Same implementation as hasOne relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
    {
		//return $this->hasOne('App\Models\Abz\Abz_Employees', 'id', 'superior_id');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
        return $this->belongsTo('App\Models\Abz\Abz_Employees', 'superior_id', 'id')->withDefault(['name' => 'Not set']);
	}	
	
	
	
	
	
	
	/**
     * reassign a superior. Upon deleting this employee, find this employee subordinates (whose who has this deleted emplyee's ID as in their 'superior_id' column and assign them other superior with the same rank)
     *
     * @param object $data
     * @return void
     */
	function reassignSuperior($data){
		$delRank    = $data->rank_id; //deleted user rank
		$delUser_ID = $data->id;
		
		//find all deleted user' subordinates
		$subordinates        = $this->where('superior_id', $delUser_ID)->get();
        $reassingedSuperiors = $this->where('rank_id', $delRank)->get(); //find users that has same rank as deleted user and can substitute him
	    
		
		//start reasigning each subordinate with a new Superior
		$i = 0;
		foreach($subordinates as $v){
			$this->where('id', $v->id)->update([ 'superior_id' => $reassingedSuperiors[$i]->id ]);	//find each user by ID from $subordinates list and update their 'superior_id' with a person from $reassingedSuperiors list
		}
		//return $reassingedSuperiors[0]->name;
	}
	
	
}