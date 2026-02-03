<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentCattleRaising extends Model
{
    use HasFactory;

    protected $table = 'treatments_cattle_raising';

    protected $fillable = [
        'health_record_id',
        'treatment_date',
        'medicine_id',
        'dose',
        'administration_route',
        'frequency',
        'observations',
    ];

    protected $casts = [
        'treatment_date' => 'date',
    ];

    // Relaciones
    public function healthRecord()
    {
        return $this->belongsTo(HealthRecordCattleRaising::class, 'health_record_id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    // Accessor para mostrar medicamento con fallback
    public function getMedicineNameAttribute()
    {
        return $this->medicine ? $this->medicine->name : 'No especificado';
    }

    // Scope para tratamientos recientes
    public function scopeRecent($query)
    {
        return $query->where('treatment_date', '>=', now()->subDays(30));
    }
}
