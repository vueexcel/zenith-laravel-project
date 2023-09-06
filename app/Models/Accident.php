<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    //
    protected $fillable = [
        'member_id',
        'accident_date',
        'reported_date',
        'logged_date',
        'supervisor_id',
        'member_statement',
        'injury_type_id',
        'body_part_id',
        'ohc_comment',
        'outcome_id',
        'seen_by_id',
        'causation_factor_id',
        'escalation',
        'lt_start_date',
        'days_lost',
        'wi_required',
        'wi_part_1_received',
        'wi_part_2_received',
        'gir_definition_id',
        'gir_reason',
        'group_code_id',
        'statistics',
        'stop_6',
        'riddor',
        'riddor_reason',
        'user_id',
        'monthly_stats',
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function injury_type()
    {
        return $this->belongsTo('App\Models\InjuryType');
    }

    public function body_part()
    {
        return $this->belongsTo('App\Models\BodyPart');
    }

    public function gir_definition()
    {
        return $this->belongsTo('App\Models\GirDefinition');
    }

    public function outcome()
    {
        return $this->belongsTo('App\Models\Outcome');
    }

    public function seen_by()
    {
        return $this->belongsTo('App\Models\SeenBy');
    }

    public function causation_factor()
    {
        return $this->belongsTo('App\Models\CausationFactor');
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
