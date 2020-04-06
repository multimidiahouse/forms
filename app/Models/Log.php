<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $table = 'log';

    public $fillable = [
        'information'
    ];

    protected $casts = [
        'id' => 'integer',
        'information' => 'string'
    ];

    public $rules = [];
}
