<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprenuer extends Model
{
    protected $guarded=['id'];

    protected $table='entreprenuers';

     function user_name(){
        return $this->belongsTo(\App\User::class,'user_id','id');
    }
}
