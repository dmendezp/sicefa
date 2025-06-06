<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\MissingCommittee;
use Modules\SIGAC\Entities\LearningOutcomeCommittee;

class ApprenticeNovelty extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ApprenticeNoveltyFactory::new();
    }

    public function apprentice (){

        return $this->belongsTo(Apprentice::class);
    }

    public function person (){

        return $this->belongsTo(Person::class);
    }

    public function missing_committee (){

        return $this->belongsTo(MissingCommittee::class);
    }

    public function learningoutcomecommittees (){

        return $this->hasMany(LearningOutcomeCommittee::class);
    }

    public function evaluation_committees(){
        
        return $this->hasMany(EvaluationCommittee::class);
    }
}
