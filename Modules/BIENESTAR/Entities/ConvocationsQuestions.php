<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConvocationsQuestions extends Model
{
    use HasFactory;

    protected $table = 'convocations_questions';

    protected $fillable = [
        'convocation_id',
        'questions_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\ConvocationsQuestionsFactory::new();
    }

    //RELACIONES
    public function convocation(){// Accede a los datos de la convocatoria al que pertenece
        return $this->belongsTo(Convocations::class, 'convocation_id');
    }

    public function question(){// Accede a los datos de la pregunta al que pertenece
        return $this->belongsTo(Questions::class, 'questions_id');
    }

    

}
