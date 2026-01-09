<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active_principle',
        'presentation',
        'dose_unit',
        'manufacturer',
        'batch',
        'expiration_date',
        'stock',
        'minimum_stock',
        'observations'
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'stock' => 'decimal:2',
        'minimum_stock' => 'decimal:2',
    ];

    // Scopes útiles
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'minimum_stock');
    }

    public function scopeNearExpiration($query, $days = 30)
    {
        return $query->whereBetween('expiration_date', [now(), now()->addDays($days)]);
    }

    public function scopeExpired($query)
    {
        return $query->where('expiration_date', '<', now());
    }

    // Relación con tratamientos
    public function treatments()
    {
        return $this->hasMany(TreatmentCattleRaising::class);
    }
}
