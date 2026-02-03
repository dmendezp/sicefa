<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeightRecord extends Model
{
    use HasFactory;

    protected $table = 'weight_records';

    protected $fillable = [
        'animal_id',
        'weigh_date',
        'weight_kg',
        'body_condition_score',
        'observations',
    ];

    protected $casts = [
        'weigh_date' => 'date',
        'weight_kg' => 'decimal:2',
    ];

    // Relación con animal
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }

    // Accessor para ganancia de peso vs anterior
    public function getWeightGainAttribute()
    {
        $previous = self::where('animal_id', $this->animal_id)
            ->where('weigh_date', '<', $this->weigh_date)
            ->orderBy('weigh_date', 'desc')
            ->first();

        if ($previous) {
            $gain = $this->weight_kg - $previous->weight_kg;
            $days = $previous->weigh_date->diffInDays($this->weigh_date);
            return [
                'gain' => $gain,
                'daily_gain' => $days > 0 ? $gain / $days : 0,
            ];
        }

        return null;
    }

    // Scope para pesajes recientes
    public function scopeRecent($query)
    {
        return $query->where('weigh_date', '>=', now()->subMonths(6));
    }
}
