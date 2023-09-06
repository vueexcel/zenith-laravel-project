<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormMss extends Model
{
    //
    protected $table = 'form_mss';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
