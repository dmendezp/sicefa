<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use OwenIt\Auditing\Contracts\Auditable;

class EnvironmentInstructorProgram extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\EnvironmentInstructorProgramFactory::new();
    }

    public function environment(){
        return $this->belongsTo(Environment::class);
    }
    public function instructor_program(){
        return $this->belongsTo(InstructorProgram::class);
    }
}
