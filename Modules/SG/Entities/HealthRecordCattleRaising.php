<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthRecordCattleRaising extends Model
{
    use HasFactory;

    protected $table = 'health_records_cattle_raising';

    protected $fillable = [
        'animal_id',
        'record_date',
        'symptoms',
        'temperature',
        'heart_rate',
        'respiratory_rate',
        'ruminal_movements',
        'fecal_consistency',
        'urine_description',
        'diagnosis',
        'veterinarian',
        'responsible',
        'observations',
    ];

    protected $casts = [
        'record_date' => 'date',
        'temperature' => 'decimal:2',
    ];

    // Relación con animal
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }

    // Relación con tratamientos (si existe la tabla treatments_cattle_raising)
    public function treatments()
    {
        return $this->hasMany(TreatmentCattleRaising::class, 'health_record_id');
    }

    // Relación con historial de cambios (versiones)
    public function histories()
    {
        return $this->hasMany(HealthRecordCattleRaisingHistory::class, 'health_record_id');
    }

    // Scope para registros recientes (últimos 30 días)
    public function scopeRecent($query)
    {
        return $query->where('record_date', '>=', now()->subDays(30));
    }
}
