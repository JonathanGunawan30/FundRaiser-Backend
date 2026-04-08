<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignImage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'campaign_id',
        'image_url',
        'order_index',
    ];

    protected $casts = [
        'order_index' => 'integer',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
