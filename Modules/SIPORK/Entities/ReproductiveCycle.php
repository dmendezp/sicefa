<?php

namespace Modules\SIPORK\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReproductiveCycle extends Model
{
    use HasFactory;
    protected $table = 'reproductive_cycles';
    protected $primaryKey = 'id_cycle';
    public $timestamps = true;

    protected $fillable = [
        'sow_id',
        'service_date',
        'birth_date',
        'live_piglets',
        'dead_piglets',
        'lactation_end_date',
    ];

    public function sow()
    {
        return $this->belongsTo(Pig::class, 'sow_id', 'id_pig');
    }
}
