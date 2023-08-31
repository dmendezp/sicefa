<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answers extends Model
{
    use HasFactory;


    protected $table = 'answers';


    protected $fillable = [
        'answer',
        'questions_id',
        'postulation_id',
        'score',
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class, 'questions_id');
    }

    public function postulation()
    {
        return $this->belongsTo(Postulations::class, 'postulation_id');
    }

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AnswersFactory::new();
    }

    
}
