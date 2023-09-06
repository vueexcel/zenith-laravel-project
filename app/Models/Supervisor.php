<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    //


    public function group_code()
    {
        return $this->belongsTo('App\Models\GroupCode');
    }
}
