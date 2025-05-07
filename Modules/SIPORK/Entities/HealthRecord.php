<?php

namespace Modules\SIPORK\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthRecord extends Model
{
    use HasFactory;
    protected $table = 'health_records';
    protected $primaryKey = 'id_health';
    public $timestamps = true;

    protected $fillable = [
        'pig_id',
        'record_type',
        'description',
        'application_date',
        'cost_id',
    ];

    public function pig()
    {
        return $this->belongsTo(Pig::class, 'pig_id', 'id_pig');
    }

    public function cost()
    {
        return $this->belongsTo(OperationalCost::class, 'cost_id', 'id_cost');
    }
}
