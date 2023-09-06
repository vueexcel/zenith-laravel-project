<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'form_id',
    ];

    public function fields()
    {
        return $this->hasMany(Field::class)->orderBy('order_number', 'ASC');
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
