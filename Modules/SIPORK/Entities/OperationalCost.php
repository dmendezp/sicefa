<?php

namespace Modules\SIPORK\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperationalCost extends Model
{
    use HasFactory;
    protected $table = 'operational_costs';
    protected $primaryKey = 'id_cost';
    public $timestamps = true;

    protected $fillable = [
        'cost_type',
        'cost_date',
        'amount',
        'description',
    ];

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'cost_id', 'id_cost');
    }
}
