<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function reduced_flexibility()
    {
        return $this->hasMany('App\Models\ReducedFlexibility');
    }
}
