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
        return $this->belongsTo('App\Models\Abz\Abz_Employees', 'superior_id', 'id');
	}	
}