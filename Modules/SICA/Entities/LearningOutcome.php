<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SIGAC\Entities\Quarterly;

class LearningOutcome extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\LearningOutcomeFactory::new();
    }

    

    public function competencie(){ //Accede a la competencia a la que pertenece.
        return $this->belongsTo(Competencie::class);
    }

    public function quarterlies(){ //Accede a todos los registros de trimestralizacion que pertenecen a este resultado.
        return $this->hasMany(Quarterly::class);
    }

    public function people(){ //Accede a todos los perfiles que se relacionan con este resultado de aprendizaje. (PIVOTE)
        return $this->belongsToMany(Person::class);
    }

    public function class_environments(){ //Accede a todas las clases de ambientes que se relacionan con este resultado de aprendizaje. (PIVOTE)
        return $this->belongsToMany(ClassEnvironment::class);
    }
}
