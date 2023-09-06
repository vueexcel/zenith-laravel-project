<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'name',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('order_number', 'ASC');
    }
}
