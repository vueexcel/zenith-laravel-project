<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyPart extends Model
{
    //

    public function health_concerns()
    {
        return $this->hasMany('App\Models\HealthConcern');
    }
}
