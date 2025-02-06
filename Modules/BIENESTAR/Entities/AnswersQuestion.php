<?php

namespace Modules\BIENESTAR\Entities;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AnswersQuestion extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at','update_at'];

    protected $table = 'answers_questions';
    
    protected $fillable = [
        'answer',
        'question_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AnswersQuestionsFactory::new();
    }

    //RELACIONES

    public function question(){// Accede a todas las preguntas que pertenecen a esta respuesta de la pregunta
        return $this->belongsTo(Question::class, 'question_id');
    }
}
