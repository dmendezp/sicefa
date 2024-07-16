<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\LearningOutcome;
use OwenIt\Auditing\Contracts\Auditable;

class InstructorProgramOutcome extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\LearningOutcomeInstructorProgramFactory::new();
    }

    public function learning_outcome()
    {
        return $this->belongsTo(LearningOutcome::class);
    }
    public function instructor_program()
    {
        return $this->belongsTo(InstructorProgram::class);
    }
}
