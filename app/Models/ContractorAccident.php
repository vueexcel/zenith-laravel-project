<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractorAccident extends Model
{
    //
    protected $fillable = [
        'member_id',
        't_number',
        'accident_date',
        'reported_date',
        'logged_date',
        'tcr_member_number',
        'contractor_name',
        'contracting_company',
        'contractor_statement',
        'injury_type_id',
        'body_part_id',
        'ohc_comment',
        'outcome_id',
        'seen_by_id',
        'causation_factor_id',
        'escalation',
        'lt_start_date',
        'days_lost',
        'report_required',
        'report_received',
        'report_received_date',
        'significant_incident',
        'date_issued',
        'group_code_id',
        'statistics',
        'stop_6',
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

    public function injury_type()
    {
        return $this->belongsTo('App\Models\Injury_type');
    }

    public function body_part()
    {
        return $this->belongsTo('App\Models\BodyPart');
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
}
