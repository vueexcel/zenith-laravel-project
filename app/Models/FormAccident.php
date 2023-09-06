<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormAccident extends Model
{
    //
    protected $table = 'form_accidents';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
