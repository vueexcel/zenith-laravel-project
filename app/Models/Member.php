<?php

namespace App\Models;

use App\Traits\Eloquent\SearchLikeTrait;
use App\Traits\Models\FillableFields;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    use FillableFields, SearchLikeTrait;

    protected $fillable = [
        'member_no', 'surname', 'name', 'title', 'birthday', 'gender', 'address1', 'address2', 'address3',
        'postal', 'phone', 'group_code', 'section', 'department', 'division', 'occupation', 'status',
        'start_date', 'leaving_date', 'ni_number', 'user_id', 'nid', 'is_deleted', 'supervisor'];

    public function getRecordTitle()
    {
        return $this->name;
    }

    public function health_concerns()
    {
        return $this->hasMany('App\Models\HealthConcern');
    }

    public function accidents()
    {
        return $this->hasMany('App\Models\Accident');
    }

    public function workplace_investigation()
    {
        return $this->hasMany('App\Models\WorkplaceInvestigation');
    }

    public function reduced_flexibility()
    {
        return $this->hasMany('App\Models\ReducedFlexibility');
    }

    public function contractor_accidents()
    {
        return $this->hasMany('App\Models\ContractorAccident');
    }

    public function exceptions()
    {
        return $this->hasMany('App\Models\Exception');
    }

}
