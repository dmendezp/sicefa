<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
class Intern extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'assigned_supervisor_id',
        'start_date',
        'end_date',
        'assigned_area',
    ];

    /**
     * Relación con la persona (el pasante).
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Relación con el supervisor asignado (también es una persona).
     */
    public function supervisor()
    {
        return $this->belongsTo(Person::class, 'assigned_supervisor_id');
    }

    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\InternFactory::new();
    }
}
