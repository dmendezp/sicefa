<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WarehouseCattleRaising extends Model
{
    use HasFactory;

    protected $table = 'warehouses_cattle_raising';

    protected $fillable = [
        'code',
        'name',
        'location',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relaciones futuras (cuando agregues warehouse_id a otras tablas)
    public function supplies()
    {
        return $this->hasMany(SupplyCattleRaising::class, 'warehouse_id');
    }

    public function tools()
    {
        return $this->hasMany(ToolCattleRaising::class, 'warehouse_id');
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'warehouse_id');
    }

    // Scope para bodegas activas
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
