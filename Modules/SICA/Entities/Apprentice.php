<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Asistencia;
use Modules\SENAEMPRESA\Entities\Loan;
use Modules\SENAEMPRESA\Entities\Postulate;
use Modules\SIGAC\Entities\Attendance;
use Modules\SIGAC\Entities\AcademicProgramming;
use Modules\BIENESTAR\Entities\Postulation;
use Modules\BIENESTAR\Entities\AssignTransportRoute;

class Apprentice extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'course_id',
        'apprentice_status',
        'guardian',
        'guardian_telephone'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function getCodeCursoAttribute()
    { // Obtener el codigo del curso (ACCESOR)
        return $this->course->code;
    }
    public function getCursoyProgramaNameAttribute()
    { // Obtener el nombre del programa y el código del curso (ACCESOR)
        return $this->Course->Program->name . ' - ' . $this->Course->code;
    }
    public function setGuardianAttribute($value)
    { // Convertir a mayúsculas en valor del dato guardian (MUTADOR)
        return $this->attributes['guardian'] = mb_strtoupper($value);
    }


    // RELACIONES
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
    public function academic_programmings(){ // Accede a las asistencias académicas asignadas a este aprendiz
        return $this->belongsToMany(AcademicProgramming::class)->withTimestamps()->withPivot('attendance_type');
    }
    public function asistencias(){
        return $this->belongsToMany(Asistencia::class)->withTimestamps()->withPivot('asistencia');
    }
    public function course()
    { // Accede al curso formativo al que pertenece
        return $this->belongsTo(Course::class);
    }
    public function person()
    { // Accede a los datos de la persona al que pertenece
        return $this->belongsTo(Person::class);
    }

    public function postulates()
    { // Accede a los datos de los postulados a las vacantes de senaempresa
        return $this->hasMany(Postulate::class);
    }

    public function loans()
    { // Accede a los datos de los prestamos
        return $this->hasMany(Loan::class);
    }
    public function postulations(){// Accede a los datos del aprendiz al que pertenece
        return $this->hasMany(Postulation::class);
    }
    public function assigntransportroutes(){
        return $this->hasMany(AssignTransportRoute::class);
    }

    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\ApprenticeFactory::new();
    }
}
