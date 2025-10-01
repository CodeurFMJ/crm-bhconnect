<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'user_id', 'mailable_type', 'mailable_id', 'channel', 'to', 'subject', 'body', 'provider_message_id', 'status', 'meta', 'sent_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'sent_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mailable(): MorphTo
    {
        return $this->morphTo();
    }
}





