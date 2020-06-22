<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignModel extends Model
{
    protected $guarded=['id'];

    protected $table='assign_emails';
}
