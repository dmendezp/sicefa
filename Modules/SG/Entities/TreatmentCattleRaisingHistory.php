<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentCattleRaisingHistory extends Model
{
    use HasFactory;

    protected $table = 'treatment_cattle_raising_histories';

    protected $fillable = [
        'treatment_id',
        'health_record_id',
        'snapshot',
        'created_by',
    ];

    protected $casts = [
        'snapshot' => 'array',
    ];

    public function treatment()
    {
        return $this->belongsTo(TreatmentCattleRaising::class, 'treatment_id');
    }

    public function healthRecord()
    {
        return $this->belongsTo(HealthRecordCattleRaising::class, 'health_record_id');
    }
}
