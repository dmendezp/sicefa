<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Question extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'questions';

    protected $fillable = [
        'question',
        'type_question',
        'score',
    ];

   
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\QuestionsFactory::new();
    }

    //RELACIONES

    public function answers(){// Accede a los datos de la respuesta al que pertenece
        return $this->hasMany(Answer::class,'questions_id');
    }

    public function answersquestions(){// Accede a los datos de la respuesta a la pregunta al que pertenece
        return $this->hasMany(AnswersQuestion::class,'questions_id');
    }

    public function convocationsquestions(){// Accede a los datos de la pregunta a la convocatoria al que pertenece
        return $this->hasMany(ConvocationQuestion::class,'questions_id');
    }

    

    
}
