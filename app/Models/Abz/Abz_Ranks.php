<?php

namespace App\Models\Abz;

//use Illuminate\Database\Eloquent\Factories\HasFactory;  //causes Crash, not found
use Illuminate\Database\Eloquent\Model;

class Abz_Ranks extends Model
{
    
	protected $table = 'abz_ranks'; //specify the DB table table
	
	//hasOne
	public function user()
    {
		return $this->hasOne('App\Models\Abz\Abz_Employees', 'rank_id', 'id');      //$this->belongsTo('App\modelName', 'foreign_key_that_table', 'parent_id_this_table');}

        //return $this->belongsTo('App\Models\Abz\Abz_Employees', 'id', 'rank_id');
    }
	
  

   
}