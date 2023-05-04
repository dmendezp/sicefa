<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Asistencia;

class Apprentice extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimiento realizados en BD

    use SoftDeletes; // Borrado suave

    use HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'course_id',
        'apprentice_status',
        'guardian',
        'guardian_telephone'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovechas las funciones de formato y manipulación de fecha y hora)

    protected $hidden = [// Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setGuardianAttribute($value){ // Convertir a mayúsculas en valor del dato guardian (MUTADOR)
        return $this->attributes['guardian'] = mb_strtoupper($value);
    }
    public function getCursoyProgramaNameAttribute(){ // Obtener el nombre del programa y el código del curso (ACCESOR)
        return $this->Course->Program->name.' - '.$this->Course->code;
    }
    public function getCodeCursoAttribute(){ // Obtener el codigo del curso (ACCESOR)
        return $this->course->code;
    }

    // RELACIONES
    public function person(){ // Accede a los datos de la persona asociada
        return $this->belongsTo(Person::class);
    }
    public function course(){ // Accede al curso formativo asociado
        return $this->belongsTo(Course::class);
    }
    public function asistencias(){
        return $this->belongsToMany(Asistencia::class)->withTimestamps()->withPivot('asistencia');
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\ApprenticeFactory::new();
    }

}
