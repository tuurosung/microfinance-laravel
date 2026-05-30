<?php

namespace App\Models\System;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordLock extends Model
{
    protected $fillable = [
        'lockable_type', 'lockable_id',
        'locked_by', 'locked_at',
        'expires_at', 'session_id'
    ];

    protected $casts = [
        'locked_at' => 'datetime',
        'expires_at' => 'datetime'
    ];


    public function lockedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'locked_by');
    }


    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }


    public function isHeldBy(User $user): bool
    {
        return $this->locked_by === $user->id;
    }
}
