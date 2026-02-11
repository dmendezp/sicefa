<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthRecordCattleRaisingHistory extends Model
{
    use HasFactory;

    protected $table = 'health_record_cattle_raising_histories';

    protected $fillable = [
        'health_record_id',
        'animal_id',
        'snapshot',
        'created_by',
    ];

    protected $casts = [
        'snapshot' => 'array',
    ];

    public function healthRecord()
    {
        return $this->belongsTo(HealthRecordCattleRaising::class, 'health_record_id');
    }
}
