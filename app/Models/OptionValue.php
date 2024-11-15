<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'values' => 'array'
    ];

    public $timestamps = false;
}
