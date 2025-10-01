<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'target_value',
        'unit',
        'period',
        'description',
        'is_active'
    ];

    protected $casts = [
        'target_value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Scope pour les objectifs actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour un type d'objectif spécifique
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope pour une période spécifique
     */
    public function scopeOfPeriod($query, $period)
    {
        return $query->where('period', $period);
    }

    /**
     * Obtenir la valeur formatée avec l'unité
     */
    public function getFormattedTargetAttribute()
    {
        if ($this->unit === 'FCFA') {
            return number_format($this->target_value, 0, ',', ' ') . ' ' . $this->unit;
        }
        
        return $this->target_value . ' ' . $this->unit;
    }
}