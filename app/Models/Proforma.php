<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'created_by', 'number', 'subtotal', 'tax', 'total', 'currency', 'status', 'items', 'sent_at',
    ];

    protected $casts = [
        'items' => 'array',
        'sent_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}





