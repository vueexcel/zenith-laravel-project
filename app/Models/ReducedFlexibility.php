<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReducedFlexibility extends Model
{
    //
    protected $fillable = [
        'member_id',
        'supervisor_id',
        'outcome',
        'l4_date',
        'restricted_status',
        'category_id',
        'no_of_online_processes',
        'no_of_offline_processes',
        'comments',
        'group_code_id',
        'initial_medical_date',
        'Initial_medical_time',
        'temp_placed_in_headcount_position',
        'perm_placed_in_headcount_position',
        'placement_date',
        'process',
        'action',
        'resp',
        'timing',
        'origin',
        'actual_timing',
        'last_review',
        'ramp_up',
        'fully_fit_date',
        'user_id'
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor');
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }


    public function group_code()
    {
        return $this->belongsTo('App\Models\GroupCode');
    }

    public function getRecordTitle()
    {
        return $this->member->name;
    }
}
