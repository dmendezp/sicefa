<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SIGAC\Entities\Quarterly;
use Modules\SIGAC\Entities\InstructorProgramOutcome;
use Modules\SIGAC\Entities\EvaluativeJudgment;
use OwenIt\Auditing\Contracts\Auditable;

class LearningOutcome extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = [
        'competencie_id',
        'name',
        'hour'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\LearningOutcomeFactory::new();
    }

    

    public function competencie(){ //Accede a la competencia a la que pertenece.
        return $this->belongsTo(Competencie::class);
    }
    public function evaluative_judgments(){ // Accede a todos los juicios evaluativos de este resultado
        return $this->hasMany(EvaluativeJudgment::class);
    }
    public function instructor_program_outcomes(){ //Accede a todos los registros de trimestralizacion que pertenecen a este resultado.
        return $this->hasMany(InstructorProgramOutcome::class);
    }
    public function quarterlies(){ //Accede a todos los registros de trimestralizacion que pertenecen a este resultado.
        return $this->hasMany(Quarterly::class);
    }
    public function people(){ //Accede a todos los perfiles que se relacionan con este resultado de aprendizaje. (PIVOTE)
        return $this->belongsToMany(Person::class, 'learning_outcome_people');
    }
    public function learning_outcome_person(){ //Accede a todos los perfiles que se relacionan con este resultado de aprendizaje. (PIVOTE)
        return $this->hasMany(LearningOutcomePerson::class, 'learning_outcome_people');
    }
}
