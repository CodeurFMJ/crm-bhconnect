<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assignedClients()
    {
        return $this->hasMany(Client::class, 'assigned_user_id');
    }

    public function proformas()
    {
        return $this->hasMany(Proforma::class, 'created_by');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }

    public function createdAppointments()
    {
        return $this->hasMany(Appointment::class, 'created_by');
    }

    public function approvedAppointments()
    {
        return $this->hasMany(Appointment::class, 'approved_by');
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'assigned_by');
    }

    public function pendingTasks()
    {
        return $this->assignedTasks()->where('status', 'pending');
    }

    public function inProgressTasks()
    {
        return $this->assignedTasks()->where('status', 'in_progress');
    }

    public function completedTasks()
    {
        return $this->assignedTasks()->where('status', 'completed');
    }

    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class);
    }

    public function lastLogin()
    {
        return $this->loginLogs()->logins()->latest('logged_at')->first();
    }

    public function lastLogout()
    {
        return $this->loginLogs()->logouts()->latest('logged_at')->first();
    }

    public function isCurrentlyOnline()
    {
        $lastLogin = $this->lastLogin();
        $lastLogout = $this->lastLogout();
        
        if (!$lastLogin) {
            return false;
        }
        
        if (!$lastLogout) {
            return true;
        }
        
        return $lastLogin->logged_at > $lastLogout->logged_at;
    }

    public function getCurrentSessionDuration()
    {
        $lastLogin = $this->lastLogin();
        
        if (!$lastLogin || !$this->isCurrentlyOnline()) {
            return null;
        }
        
        return $lastLogin->logged_at->diffForHumans(null, true);
    }

    public function getTotalOnlineTimeToday()
    {
        $today = now()->startOfDay();
        $loginLogs = $this->loginLogs()
            ->where('logged_at', '>=', $today)
            ->orderBy('logged_at')
            ->get();
        
        $totalMinutes = 0;
        $loginTime = null;
        
        foreach ($loginLogs as $log) {
            if ($log->action === 'login') {
                $loginTime = $log->logged_at;
            } elseif ($log->action === 'logout' && $loginTime) {
                $totalMinutes += $loginTime->diffInMinutes($log->logged_at);
                $loginTime = null;
            }
        }
        
        // Si l'utilisateur est encore connecté
        if ($loginTime) {
            $totalMinutes += $loginTime->diffInMinutes(now());
        }
        
        return $totalMinutes;
    }

    public function getFormattedOnlineTimeToday()
    {
        $minutes = $this->getTotalOnlineTimeToday();
        
        if ($minutes === 0) {
            return '0 min';
        }
        
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        
        if ($hours > 0) {
            return $hours . 'h ' . $remainingMinutes . 'min';
        }
        
        return $minutes . ' min';
    }
}
