<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Questions extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'questions';

    protected $fillable = [
        'name',
        'type_question',
        'score',
    ];

   
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\QuestionsFactory::new();
    }

    //RELACIONES

    public function answers(){
        return $this->hasMany(Answers::class);
    }

    

    public function convocationsquestions(){
        return $this->hasMany(ConvocationQuestion::class);
    }

    public function answersquestions(){
        return $this->hasMany(AnswersQuestions::class);
    }

    
}
