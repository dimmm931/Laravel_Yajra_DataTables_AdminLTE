<?php

namespace App\Models\Abz;

use Illuminate\Database\Eloquent\Model;

class Abz_Ranks extends Model
{
	protected $table = 'abz_ranks'; //specify the DB table table
	
	/**
     * Relation hasOne
     * @return hasOne
     *
     */
	public function user()
    {
		return $this->hasOne('App\Models\Abz\Abz_Employees', 'rank_id', 'id');  
    }
	
  

   
}