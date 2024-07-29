<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;

class InstructorProgramPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_program_id',
        'person_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\InstructorProgramPersonFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function instructor_program()
    {
        return $this->belongsTo(InstructorProgram::class);
    }

    
}
