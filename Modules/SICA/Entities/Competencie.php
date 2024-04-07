<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Competencie extends Model
{
    use HasFactory;

    protected $fillable = ['program_id', 'name', 'hour', 'type', 'code'];
    
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\CompetencieFactory::new();
    }

    public function learning_outcomes(){ // Accede a la información de los resultados de aprendizaje
        return $this->hasMany(LearningOutcome::class);
    }
    public function program(){ // Accede a la información del programa
        return $this->belongsTo(Program::class);
    }

    
}
