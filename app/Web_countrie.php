<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web_countrie extends Model
{
    function _state(){
            return $this->belongsTo(\App\Web_state::class,'id')->with('_city');
    }
}
