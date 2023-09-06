<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RampUp extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ramp_up',
    ];


    //
    protected $table = 'ramp_up';
}
