<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'name',
        'field_id',
    ];

    public function section()
    {
        return $this->belongsTo(Field::class);
    }
}
