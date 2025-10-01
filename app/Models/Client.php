<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'age', 'revenue', 'assigned_user_id', 'status',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(ClientDocument::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function proformas(): HasMany
    {
        return $this->hasMany(Proforma::class);
    }
}


