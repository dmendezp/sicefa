<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MilkProduction extends Model
{
    use HasFactory;

    protected $table = 'milk_productions';

    protected $fillable = [
        'animal_id',
        'production_date',
        'shift',
        'liters',
        'quality',
        'milk_temperature',
        'observations',
        'responsible'
    ];

    protected $casts = [
        'production_date' => 'date',
        'liters' => 'decimal:2',
        'milk_temperature' => 'decimal:2',
    ];

    // Relación con animal
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }

    // Scope por turno
    public function scopeMorning($query) { return $query->where('shift', 'MORNING'); }
    public function scopeAfternoon($query) { return $query->where('shift', 'AFTERNOON'); }
    public function scopeNight($query) { return $query->where('shift', 'NIGHT'); }

    // Scope por calidad
    public function scopeHighQuality($query) { return $query->where('quality', 'HIGH'); }
    public function scopeMediumQuality($query) { return $query->where('quality', 'MEDIUM'); }
    public function scopeLowQuality($query) { return $query->where('quality', 'LOW'); }

    // Accessor para turno en español
    public function getShiftInSpanishAttribute()
    {
        return match($this->shift) {
            'MORNING'    => 'Mañana',
            'AFTERNOON'  => 'Tarde',
            'NIGHT'      => 'Noche',
            default      => $this->shift
        };
    }

    public function getQualityInSpanishAttribute()
    {
        return match($this->quality) {
            'HIGH'   => 'Alta',
            'MEDIUM' => 'Media',
            'LOW'    => 'Baja',
            default  => $this->quality
        };
    }
}
