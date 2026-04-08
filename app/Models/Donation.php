<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Donation extends Model
{
    protected $fillable = [
        'donation_number',
        'campaign_id',
        'user_id',
        'amount',
        'message',
        'is_anonymous',
        'status',
    ];

    protected $casts = [
        'amount' => 'integer',
        'is_anonymous' => 'boolean',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(DonationPayment::class);
    }
}
