<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ConvocationsQuestions extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

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
