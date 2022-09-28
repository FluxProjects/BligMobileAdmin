<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invertor extends Model
{
    protected $guarded=['id'];

    protected $table='investors';

    function user_name(){
        return $this->belongsTo(\App\User::class,'user_id','id');
    }
}
