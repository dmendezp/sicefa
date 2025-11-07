<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\LearningOutcome;
use OwenIt\Auditing\Contracts\Auditable;

class Quarterly extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['hour','quarter_number','training_project_id','learning_outcome_id'];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\QuarterlyFactory::new();
    }

    public function learning_outcome(){ //Accede al resultado de aprendizaje al que pertenece.
        return $this->belongsTo(LearningOutcome::class);
    }

    public function training_project(){ //Accede al proyecto forrmativo al que pertenece.
        return $this->belongsTo(TrainingProject::class);
    }   

    public function instructor_programs(){ //Accede al proyecto forrmativo al que pertenece.
        return $this->hasMany(InstructorProgram::class);
    }
}
