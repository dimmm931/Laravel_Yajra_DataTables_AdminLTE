<?php

namespace App\Models\Abz;

//use Illuminate\Database\Eloquent\Factories\HasFactory;  //causes Crash, not found
use Illuminate\Database\Eloquent\Model;

class Abz_Employees extends Model
{
	protected $table = 'abz_employees'; //specify the DB table table
	
	
    //use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'dob',
    ]; 


    public function getRank() //hasOne Relation. Same implementation as hasOne relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
    {
		return $this->hasOne('App\Models\Abz\Abz_Ranks', 'id', 'rank_id');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
    }

     public function getSuperior() //hasOne Relation. Same implementation as hasOne relation in JSON (REST API). See ReadMe_Laravel_Com_Commands.txt
    {
		return $this->hasOne('App\Models\Abz\Abz_Employees', 'id', 'superior_id');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}
    }	
}