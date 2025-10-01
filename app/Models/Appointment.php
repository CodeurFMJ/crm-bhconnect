<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'scheduled_at', 'subject', 'details', 'status',
        'approval_status', 'created_by', 'approved_by', 'admin_notes', 
        'approved_at', 'rescheduled_to'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'approved_at' => 'datetime',
        'rescheduled_to' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isPending()
    {
        return $this->approval_status === 'pending';
    }

    public function isApproved()
    {
        return $this->approval_status === 'approved';
    }

    public function isRejected()
    {
        return $this->approval_status === 'rejected';
    }

    public function isRescheduled()
    {
        return $this->approval_status === 'rescheduled';
    }
}


