<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LoginLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'logged_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLogins($query)
    {
        return $query->where('action', 'login');
    }

    public function scopeLogouts($query)
    {
        return $query->where('action', 'logout');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('logged_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('logged_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('logged_at', now()->month)
                    ->whereYear('logged_at', now()->year);
    }
}
