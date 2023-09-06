<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswersQuestions extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'question_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AnswersQuestionsFactory::new();
    }
}
