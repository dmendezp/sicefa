<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Insemination extends Model
{
    use HasFactory;

    protected $table = 'inseminations';

    protected $fillable = [
        'animal_id',
        'insemination_date',
        'straw_code',
        'bull_id',
        'bull_name',
        'technician',
        'method',
        'observations',
        'palpation_result',
        'palpation_date',
        'gestation_days',
        'expected_birth_date',
    ];

    protected $casts = [
        'insemination_date'   => 'date',
        'palpation_date'      => 'date',
        'expected_birth_date' => 'date',
    ];

    // Relaciones
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }

    public function bull()
    {
        return $this->belongsTo(Animal::class, 'bull_id', 'id');
    }

    // Accessor: Días desde inseminación hasta hoy
    public function getDaysSinceInseminationAttribute()
    {
        return $this->insemination_date ? Carbon::parse($this->insemination_date)->diffInDays(now()) : null;
    }

    // Accessor: Estado de gestación en texto
    public function getGestationStatusAttribute()
    {
        if ($this->palpation_result === 'POSITIVE') return 'Preñada confirmada';
        if ($this->palpation_result === 'NEGATIVE') return 'No preñada';
        if ($this->palpation_result === 'PENDING') {
            $days = $this->days_since_insemination;
            if ($days >= 45) return 'Palpación pendiente (más de 45 días)';
            return 'Palpación pendiente';
        }
        return 'Sin resultado';
    }

    // Scope para inseminaciones pendientes de palpación
    public function scopePendingPalpation($query)
    {
        return $query->where('palpation_result', 'PENDING')
                     ->where('insemination_date', '<=', now()->subDays(45));
    }
}
