<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

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

    public function workplace_investigation()
    {
        return $this->belongsTo('App\Models\WorkplaceInvestigation');
    }

    public function reduced_flexibility()
    {
        return $this->belongsTo('App\Models\ReducedFlexibility');
    }


    public function contractor_accident()
    {
        return $this->belongsTo('App\Models\ContractorAccident');
    }
}
