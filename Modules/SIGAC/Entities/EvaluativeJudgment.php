<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\LearningOutcome;

class EvaluativeJudgment extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\EvaluativeJudgmentFactory::new();
    }

    public function person(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Person::class);
    }

    public function course(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Course::class);
    }

    public function learning_outcome(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(LearningOutcome::class);
    }
}
