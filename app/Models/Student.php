<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;  //causes Crash, not found
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'dob',
    ];    
}