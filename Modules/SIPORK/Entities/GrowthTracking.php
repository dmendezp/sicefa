<?php

namespace Modules\SIPORK\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrowthTracking extends Model
{
    use HasFactory;
    protected $table = 'growth_tracking';
    protected $primaryKey = 'id_tracking';
    public $timestamps = true;

    protected $fillable = [
        'pig_id',
        'measurement_date',
        'weight',
        'observations',
    ];

    public function pig()
    {
        return $this->belongsTo(Pig::class, 'pig_id', 'id_pig');
    }
}
