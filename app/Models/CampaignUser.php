<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignUser extends Model
{
    public $table = 'campaign_user';

    public $fillable = [
        'campaign_id',
        'user_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'campaign_id' => 'integer',
        'user_id' => 'integer'
    ];

    public $rules = [];
}
