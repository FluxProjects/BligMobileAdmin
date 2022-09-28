<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=['id'];

    function _permission(){
            return $this->hasMany(\App\Role_has_permission::class);
    }

    function _role_group(){
            return $this->hasMany(\App\Role_group::class,'group_role_id','id');
    }
}
