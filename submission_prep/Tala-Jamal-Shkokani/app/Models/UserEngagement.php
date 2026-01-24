<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEngagement extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'engageable_type',
        'engageable_id',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function engageable()
    {
        return $this->morphTo();
    }
}
