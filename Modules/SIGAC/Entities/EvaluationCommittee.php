<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationCommittee extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\EvaluationCommitteeFactory::new();
    }

    public function apprentice_novelty(){
        
        return $this->belongsTo(ApprenticeNovelty::class);
    }

    public function committee_staffs(){
        
        return $this->hasMany(CommitteeStaff::class);
    }
}
