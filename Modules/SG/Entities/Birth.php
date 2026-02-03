<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Birth extends Model
{
    use HasFactory;

    protected $table = 'births';

    protected $fillable = [
        'animal_id',
        'insemination_date',
        'bull_id',
        'palpation_date',
        'gestation_days',
        'diagnosis_note',
        'expected_birth_date',
        'birth_date',
        'calf_sex',
        'calf_id',
        'observations',
    ];

    protected $casts = [
        'insemination_date'   => 'date',
        'palpation_date'      => 'date',
        'expected_birth_date' => 'date',
        'birth_date'          => 'date',
    ];

    // Relaciones
    public function mother()
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }

    public function bull()
    {
        return $this->belongsTo(Animal::class, 'bull_id', 'id');
    }

    public function calf()
    {
        return $this->belongsTo(Animal::class, 'calf_id', 'id');
    }

    // Accessor: Días de gestación reales
    public function getRealGestationDaysAttribute()
    {
        if (!$this->birth_date || !$this->insemination_date) return null;
        return $this->insemination_date->diffInDays($this->birth_date);
    }

    // Accessor: Estado del parto
    public function getBirthStatusAttribute()
    {
        if (!$this->birth_date) return 'Pendiente';
        return $this->calf_id ? 'Parto registrado con éxito' : 'Parto registrado (cría no vinculada)';
    }
}
