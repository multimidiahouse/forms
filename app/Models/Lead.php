<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public $table = 'lead';
	
	public $fillable = [
		'campaign_id',
		'information'
	];
	
	protected $casts = [
		'id' => 'integer',
		'campaign_id' => 'integer',
		'information' => 'string'
	];
	
	public $rules = [];
}
