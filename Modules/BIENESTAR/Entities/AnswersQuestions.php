<?php

namespace Modules\BIENESTAR\Entities;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class AnswersQuestions extends Model implements Auditable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'answer',
        'question_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AnswersQuestionsFactory::new();
    }
}
