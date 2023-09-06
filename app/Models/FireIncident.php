<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FireIncident extends Model
{
    //
    protected $fillable = [
        'logged_date',
        'incident_date',
        'reported_date',
        'member_id',
        'group_code_id',
        'location',
        'summary',
        'work_type_id',
        'root_cause',
        'significant',
        'stop6'
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }


    public function group_code()
    {
        return $this->belongsTo('App\Models\GroupCode');
    }

    public function work_type()
    {
        return $this->belongsTo('App\Models\WorkType');
    }

    public function getRecordTitle()
    {
        return $this->t_number;
    }
}
