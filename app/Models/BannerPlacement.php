<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BannerPlacement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'banner_id',
        'placement',
    ];

    public function banner(): BelongsTo
    {
        return $this->belongsTo(Banner::class);
    }
}
