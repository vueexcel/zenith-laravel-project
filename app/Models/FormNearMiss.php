<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormNearMiss extends Model
{
    //
    protected $table = 'form_near_miss';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
