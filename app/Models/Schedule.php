<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'id',
        'user_id',	
        'start',	
        'end'	
    ];

    public $timestamps = false;


    
}