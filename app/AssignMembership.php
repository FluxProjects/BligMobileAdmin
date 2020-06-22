<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignMembership extends Model
{
    protected $guarded=['id'];

    protected $table='assign_memberships';

    function _membership(){
            return $this->hasOne(\App\Membership_plane::class,'id','membership_id');
    }
}
