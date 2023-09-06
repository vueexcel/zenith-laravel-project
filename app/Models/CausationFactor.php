<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CausationFactor extends Model
{
    //
    public function accidents()
    {
        return $this->hasMany('App\Models\Accident');
    }
}
