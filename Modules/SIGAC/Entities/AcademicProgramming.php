<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Person;
use OwenIt\Auditing\Contracts\Auditable;

class AcademicProgramming extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'instructor_id',
        'course_id',
        'environment_id',
        'start_date',
        'end_date'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function apprentices(){ // Accede a los aprendices asociados a esta programación académica
        return $this->belongsToMany(Apprentice::class)->withTimestamps()->withPivot('attendance_type');
    }
    public function course(){ // Accede al curso al que pertenece
        return $this->belongsTo(Course::class);
    }
    public function environment(){ // Accede al ambiente al que pertenece
        return $this->belongsTo(Environment::class);
    }
    public function instructor(){ // Accede a la información del instructor asignado
        return $this->belongsTo(Person::class, 'instructor_id');
    }

}
