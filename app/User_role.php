<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    protected $guarded=['id'];

    protected $table='user_roles';

    function _role_name(){
            return $this->hasMany(\App\Role::class,'id','role_id');
    }
    function _user_name(){
            return $this->hasOne(\App\User::class,'id','user_id');
    }
}
