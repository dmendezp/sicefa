<?php

namespace Modules\BIENESTAR\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;


class Answers extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];



    protected $table = 'answers';


    protected $fillable = [
        'answer',
        'questions_id',
        'postulation_id',
        'score',
    ];

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AnswersFactory::new();
    }

    // RELACIONES
    
    public function postulation(){// Accede a todas las postulaciones que pertenecen a esta respuesta
    return $this->belongsTo(Postulations::class, 'postulation_id');
}
    
    
    public function question(){// Accede a todas las preguntas que pertenecen a esta respuesta
        return $this->belongsTo(Questions::class, 'questions_id');
    }

    



    
}
