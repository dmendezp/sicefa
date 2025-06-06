<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\LearningOutcome;

class LearningOutcomeCommittee extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\LearningOutcomeCommitteeFactory::new();
    }

    public function learning_outcome (){

        return $this->belongsTo(LearningOutcome::class);
    }
}
