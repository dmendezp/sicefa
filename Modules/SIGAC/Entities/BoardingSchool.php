<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;

class BoardingSchool extends Model
{
    use HasFactory;

    protected $table = 'boarding_schools';

    protected $fillable = [
        'person_id',
        'start_date',
        'end_date',
        'type',
        'area',
        'assigned_supervisor_id',
    ];

    // Casts para que Laravel trate start_date y end_date como fechas (Carbon)
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relación con la persona (el pasante)
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    // Relación con el supervisor asignado
    public function supervisor()
    {
        return $this->belongsTo(Person::class, 'assigned_supervisor_id');
    }

    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\BoardingSchoolFactory::new();
    }
}
