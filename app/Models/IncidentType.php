<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentType extends Model
{
    //

    public function workplace_investigation()
    {
        return $this->hasMany('App\Models\WorkplaceInvestigation');
    }
}
