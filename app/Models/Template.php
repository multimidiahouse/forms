<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public $table = 'template';

	public $fillable = [
	    'title',
		'html',
        'response'
	];

	protected $casts = [
		'id' => 'integer',
        'title' => 'string',
		'html' => 'string',
        'response' => 'string'
	];

	public $rules = [];
}
