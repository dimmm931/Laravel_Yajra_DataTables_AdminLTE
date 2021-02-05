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
}