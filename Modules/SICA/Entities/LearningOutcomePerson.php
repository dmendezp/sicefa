<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearningOutcomePerson extends Model
{
    use HasFactory;

    protected $fillable = ['learnin_outcome_id','person_id','priority'];
    
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\LearningOutcomePersonFactory::new();
    }

    public function learning_outcome(){ //Accede a todos los perfiles que se relacionan con este resultado de aprendizaje. (PIVOTE)
        return $this->belongsTo(LearningOutcome::class);
    }

    public function person(){ //Accede a todos los perfiles que se relacionan con este resultado de aprendizaje. (PIVOTE)
        return $this->belongsTo(Person::class);
    }
}
