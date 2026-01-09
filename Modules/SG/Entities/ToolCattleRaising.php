<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ToolCattleRaising extends Model
{
    use HasFactory;

    protected $table = 'tools_cattle_raising';

    protected $fillable = [
        'code',
        'name',
        'type',
        'brand',
        'model',
        'serial_number',
        'status',
        'location',
        'acquisition_date',
        'purchase_value',
        'current_responsible',
        'observations',
        'is_active'
    ];

    protected $casts = [
        'acquisition_date' => 'date',
        'purchase_value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeOperational($query) { return $query->where('status', 'OPERATIONAL'); }
    public function scopeInMaintenance($query) { return $query->where('status', 'MAINTENANCE'); }
    public function scopeDamaged($query) { return $query->where('status', 'DAMAGED'); }
    public function scopeOutOfService($query) { return $query->where('status', 'OUT_OF_SERVICE'); }
    public function scopeActive($query) { return $query->where('is_active', true); }

    // Accessor para estado en español
    public function getStatusInSpanishAttribute()
    {
        return match($this->status) {
            'OPERATIONAL'     => 'Operativa',
            'MAINTENANCE'     => 'En Mantenimiento',
            'DAMAGED'         => 'Dañada',
            'OUT_OF_SERVICE'  => 'Fuera de Servicio',
            default           => $this->status
        };
    }

    // Accessor para tipo en español
    public function getTypeInSpanishAttribute()
    {
        return match($this->type) {
            'SCALE'       => 'Báscula',
            'EAR_TAG'     => 'Arete / Marcador',
            'SYRINGE'     => 'Jeringa',
            'THERMOMETER' => 'Termómetro',
            'OTHER'       => 'Otro',
            default       => $this->type
        };
    }
}
