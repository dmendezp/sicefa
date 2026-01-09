<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplyCattleRaising extends Model
{
    use HasFactory;

    protected $table = 'supplies_cattle_raising';

    protected $fillable = [
        'code',
        'name',
        'type',
        'unit',
        'presentation',
        'current_stock',
        'minimum_stock',
        'unit_price',
        'supplier',
        'expiration_date',
        'batch_number',
        'observations',
        'is_active'
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'current_stock' => 'decimal:3',
        'minimum_stock' => 'decimal:3',
        'unit_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeLowStock($query)
    {
        return $query->whereColumn('current_stock', '<=', 'minimum_stock');
    }

    public function scopeNearExpiration($query, $days = 30)
    {
        return $query->where('expiration_date', '<=', now()->addDays($days))
                     ->where('expiration_date', '>=', now());
    }

    public function scopeExpired($query)
    {
        return $query->where('expiration_date', '<', now());
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor para tipo en español
    public function getTypeInSpanishAttribute()
    {
        return match($this->type) {
            'MEDICINE'   => 'Medicamento',
            'VACCINE'    => 'Vacuna',
            'FEED'       => 'Alimento',
            'SUPPLEMENT' => 'Suplemento',
            'OTHER'      => 'Otro',
            default      => $this->type
        };
    }
}
