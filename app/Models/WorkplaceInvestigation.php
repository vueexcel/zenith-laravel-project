<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkplaceInvestigation extends Model
{
    //
    protected $fillable = [
        'site',
        'incident_type_id',
        'logged_date',
        'incident_date',
        'reported_date',
        'member_id',
        'incident_location',
        'supervisor',
        'group_code_id',
        'key_point_summary',
        'repeat',
        's4_ok',
        'visibility_ok',
        'equipment_ok',
        'ppe_worn',
        'ra_completed',
        'mbr_authorised',
        'stds_followed',
        'work_type_id',
        'root_cause',
        'escalation',
        'significant_incident',
        'date_issued',
        'mss_causation_id',
        'stop_6',
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

    public function work_type()
    {
        return $this->belongsTo('App\Models\WorkType');
    }

    public function incident_type()
    {
        return $this->belongsTo('App\Models\IncidentType');
    }

    public function group_code()
    {
        return $this->belongsTo('App\Models\GroupCode');
    }

    public function mss_causation()
    {
        return $this->belongsTo('App\Models\MssCausation');
    }

    public function getRecordTitle()
    {
        if($this->member)
            return $this->member->name;
        else
            return "";
    }
}
