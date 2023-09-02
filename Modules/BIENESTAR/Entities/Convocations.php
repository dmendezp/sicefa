<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Convocations extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\ConvocationsFactory::new();
    }
    //RELACIONES

    public function questions(){// Accede a los datos de la Pregunta al que pertenece
        return $this->belongsToMany(Questions::class, 'convocations_questions');
    }
    public function ConvocationsQuestions()
{
    return $this->hasMany(ConvocationsQuestions::class, 'convocation_id');
}

}
