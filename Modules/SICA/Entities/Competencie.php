<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SIGAC\Entities\Profession;
use OwenIt\Auditing\Contracts\Auditable;

class Competencie extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['program_id', 'name', 'hour', 'type', 'code'];
    
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\CompetencieFactory::new();
    }

    
    public function learning_outcomes(){ // Accede a la información de los resultados de aprendizaje
        return $this->hasMany(LearningOutcome::class);
    }

    public function professions(){   //Accede a todas las profesiones que tienen esta competencia.
        return $this->belongsToMany(Profession::class, 'competencie_professions');
    }

    public function program(){ // Accede a la información del programa
        return $this->belongsTo(Program::class);
    }

    public function class_environments(){ //Accede a todas las clases de ambientes que se relacionan con este resultado de aprendizaje. (PIVOTE)
        return $this->belongsToMany(ClassEnvironment::class,'class_environment_competencies');
    }

    
}
