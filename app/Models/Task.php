<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'assigned_to',
        'assigned_by',
        'client_id',
        'due_date',
        'notes',
        'completed_at'
    ];

    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'datetime'
    ];

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function isOverdue()
    {
        return $this->due_date && $this->due_date->isPast() && !$this->isCompleted();
    }

    public function getPriorityColor()
    {
        return match($this->priority) {
            'low' => 'success',
            'medium' => 'primary',
            'high' => 'warning',
            'urgent' => 'danger',
            default => 'secondary'
        };
    }

    public function getStatusColor()
    {
        return match($this->status) {
            'pending' => 'warning',
            'in_progress' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);
    }

    public function markAsInProgress()
    {
        $this->update([
            'status' => 'in_progress'
        ]);
    }

    public function markAsCancelled()
    {
        $this->update([
            'status' => 'cancelled'
        ]);
    }
}