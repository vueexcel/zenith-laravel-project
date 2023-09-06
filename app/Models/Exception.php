<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    //
    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function health_concern()
    {
        return $this->belongsTo('App\Models\HealthConcern');
    }

    public function accident()
    {
        return $this->belongsTo('App\Models\Accident');
    }
}
