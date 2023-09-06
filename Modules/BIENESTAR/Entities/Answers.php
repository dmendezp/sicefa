<?php

namespace Modules\BIENESTAR\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answers extends Model implements Auditable
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];



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
