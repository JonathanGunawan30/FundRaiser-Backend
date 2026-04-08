<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'link_url',
        'is_active',
        'start_at',
        'end_at',
        'order_index',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'order_index' => 'integer',
    ];

    public function placements(): HasMany
    {
        return $this->hasMany(BannerPlacement::class);
    }
}
