<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tests';

    protected $fillable = [
        'animal_id',
        'test_date',
        'test_type',
        'result',
        'observations',
    ];

    protected $casts = [
        'test_date' => 'date',
    ];

    // Relación con el animal
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }

    // Scope para pruebas recientes
    public function scopeRecent($query)
    {
        return $query->where('test_date', '>=', now()->subDays(90));
    }

    // Accessor para resultado con color
    public function getResultStatusAttribute()
    {
        if (!$this->result) return 'Pendiente';

        $resultLower = strtolower($this->result);

        if (str_contains($resultLower, 'negativo') || str_contains($resultLower, 'no detectado')) {
            return 'Negativo';
        }
        if (str_contains($resultLower, 'positivo') || str_contains($resultLower, 'detectado')) {
            return 'Positivo';
        }

        return 'Indeterminado';
    }
}
