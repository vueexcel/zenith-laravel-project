<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickNearMiss extends Model
{
    //
    protected $fillable = [
        'member_id',
        'group_code_id',
        'incident_date',
        'supervisor',
        'nature_incident',
        'initial_countermeasure',
        'completed',
        'stop_6',
        'causation_factor_id',
        'hse_reportable',
        'f2508_completed',
        'sig_incident_report_yokoten_required',
        'report_yokoten_issued',
        'a3_directors_review',
        'directors_revue_date',
        'full_wpi_required',
        'health_safety_revue_complete',
        'logged_date',
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

    public function group_code()
    {
        return $this->belongsTo('App\Models\GroupCode');
    }

    public function causation_factor()
    {
        return $this->belongsTo('App\Models\CausationFactor');
    }

    public function getRecordTitle()
    {
        return $this->member->name;
    }
}
