<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public $table = 'campaign';

	public $fillable = [
		'title',
		'slug',
		'html',
        'response'
	];

	protected $casts = [
		'id' => 'integer',
		'title' => 'string',
		'slug' => 'string',
		'html' => 'string',
        'response' => 'string'
	];

	public $rules = [];
}
