<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    protected $fillable = [
        'event_type',
        'user_id',
        'session_id',
        'url',
        'properties',
        'context'
    ];

    protected $casts = [
        'properties' => 'array',
        'context' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
