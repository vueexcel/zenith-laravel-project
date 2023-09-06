<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name',
        'input_type',
        'section_id',
        'comment',
        'is_required',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('order_number', 'ASC');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
