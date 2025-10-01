<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'title', 'file_path', 'mime_type', 'size_bytes',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}


