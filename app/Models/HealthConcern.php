<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthConcern extends Model
{
    //
    protected $fillable = [
        'member_id',
        'supervisor_id',
        'logged_date',
        'concern_date',
        'repeat',
        'level_1_date',
        'body_part_id',
        'symptoms',
        'origin',
        'origin_type_id',
        'wi_required',
        'wi_part_2_received',
        'wi_part_1_received',
        'group_code_id',
        'level_1_discharged',
        'ohc_appointment',
        'appointment_reason',
        'initial_advice',
        'next_steps_1_date',
        'next_steps_1',
        'next_steps_2_date',
        'next_steps_2',
        'next_steps_3_date',
        'next_steps_3',
        'next_steps_4_date',
        'next_steps_4',
        'next_steps_5_date',
        'next_steps_5',
        'next_steps_6_date',
        'next_steps_6',
        'next_steps_7_date',
        'next_steps_7',
        'next_steps_8_date',
        'next_steps_8',
        'next_steps_9_date',
        'next_steps_9',
        'gmir',
        'outcome',
        'next_step_id',
        'level_2_date',
        'level_2_discharged',
        'level_3_date',
        'level_3_discharged',
        'level_4_date',
        'level_4_discharged',
        'rtw_date',
        'rtw_date_revised',
        'current_level',
        'level1_raised_date',
        'ramp_up',
        'fully_fit',
        'discharge_date',
        'lost_time_mss',
        'lt_start_date',
        'mss_causation_id',
        'riddor',
        'user_id',
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

    public function body_part()
    {
        return $this->belongsTo('App\Models\BodyPart');
    }

    public function origin_type()
    {
        return $this->belongsTo('App\Models\OriginType');
    }

    public function outcome()
    {
        return $this->belongsTo('App\Models\Outcome');
    }

    public function next_step()
    {
        return $this->belongsTo('App\Models\NextStep');
    }

    public function mss_causation()
    {
        return $this->belongsTo('App\Models\MssCausation');
    }

    public function group_code()
    {
        return $this->belongsTo('App\Models\GroupCode');
    }

    public function getRecordTitle()
    {
        return $this->t_number;
    }

    public function exceptions()
    {
        return $this->hasMany('App\Models\Exception');
    }
}
