<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users2 extends Authenticatable
{
    use Notifiable;

    protected $guarded=['id'];

    function _role(){
            return $this->belongsTo(\App\User_role::class,'id','user_id')->with('_role_name');
    }

    function _country(){
            return $this->hasOne(\App\Web_countrie::class,'id','country_id');
    }

    function _city(){
            return $this->hasOne(\App\Web_citie::class,'id','city_id');
    }

    function _state(){
            return $this->hasOne(\App\Web_state::class,'id','state_id');
    }
}
