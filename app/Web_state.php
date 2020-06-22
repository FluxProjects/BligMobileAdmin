<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web_state extends Model
{
    function _city(){
            return $this->belongsTo(\App\Web_citie::class,'id');
    }
}
