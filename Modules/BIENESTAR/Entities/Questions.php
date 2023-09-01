<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'name',
        'type_question',
        'score',
    ];

    public function answers()
    {
        return $this->hasMany(Answers::class, 'questions_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\QuestionsFactory::new();
    }

    //RELACIONES

    public function convocations(){ // Accede a los datos de la Convocatoria al que pertenece
        return $this->belongsToMany(Convocations::class, 'convocations_questions');
    }

    public function ConvocationsQuestions()
{
    return $this->hasMany(ConvocationsQuestions::class, 'convocation_id');
}

    
}
