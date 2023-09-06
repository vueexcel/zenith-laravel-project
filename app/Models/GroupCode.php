<?php

namespace App\Models;

use App\Traits\Eloquent\SearchLikeTrait;
use App\Traits\Models\FillableFields;
use Illuminate\Database\Eloquent\Model;

class GroupCode extends Model
{
    //
    use FillableFields, SearchLikeTrait;

    protected $fillable = [
        'group_code', 's_generation', 's_guid', 's_lineage', 'section', 'department', 'division'
    ];

    public function getRecordTitle()
    {
        return $this->group_code;
    }

    public function accidents()
    {
        return $this->hasMany('App\Models\Accident');
    }

}
