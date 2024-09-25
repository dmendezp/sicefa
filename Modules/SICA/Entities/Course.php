<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Apprentice;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Modules\SENAEMPRESA\Entities\Senaempresa;
use Modules\AGROINDUSTRIA\Entities\RequestExternal;
use Modules\SIGAC\Entities\CourseTrainingProject;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\TrainingProject;
use Modules\SIGAC\Entities\EvaluativeJudgment;

class Course extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [// Atributos modificables (asignación masiva)
        'code',
        'star_date',
        'end_date',
        'star_production_date',
        'school_end_date',
        'status',
        'modality',
        'program_id',
        'municipality_id',
        'person_id',
        'deschooling'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function getCodeNameAttribute(){ // Obtiene el código y el nombre del programa de formación de manera concatenada
        return "{$this->code} {$this->program->name}";
    }

    // RELACIONES
    public function academic_programmings(){ // Accede a todos los registros de programaciones academicas asociadas a este curso
        return $this->hasMany(AcademicProgramming::class);
    }
    public function apprentices(){ // Accede a todos los aprendices de este curso formativo
        return $this->hasMany(Apprentice::class);
    }

    public function evaluative_judgments(){ // Accede a todos los juicios evaluativos de este curso
        return $this->hasMany(EvaluativeJudgment::class);
    }

    public function instructor_programs(){ // Accede a todas las programaciones de este curso
        return $this->hasMany(InstructorProgram::class);
    }
    public function municipality()
    { //Accede a senaempresa registrados
        return $this->belongsTo(Municipality::class);
    }

    public function person()
    { //Accede a senaempresa registrados
        return $this->belongsTo(Person::class);
    }

    public function program(){ // Accede al programa de formación al que pertenece
        return $this->belongsTo(Program::class);
    }
    public function requestexternals(){ // Accede a la información de los elementos usados en la Formula.
        return $this->hasMany(RequestExternal::class);
    }

    public function senaempresa()
    { //Accede a senaempresa registrados
        return $this->belongsToMany(Senaempresa::class);
    }

    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\CourseFactory::new();
    }

    public function training_projects(){ //Accede a todos los proyectos formativos que pertenecen a este curso.
        return $this->belongsToMany(TrainingProject::class, 'course_training_projects');
    }

    
    public function vacancy()
    { //Accede a los vacantes disponibles
        return $this->belongsToMany(Vacancy::class);
    }

    

    

}
