<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\learningOutcome;
use OwenIt\Auditing\Contracts\Auditable;


class InstructorProgram extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['course_id','activity_name','activity_description','date','start_time','end_time','quarter_number','state','modality'];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    public function attendances (){
        return $this->hasMany(Attendance::class);
    }
    public function attendance_apprentices()
    {
        return $this->hasMany(AttendanceApprentice::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function instructor_program_novelties(){
        return $this->hasMany(InstructorProgramNovelty::class);
    }
    public function instructor_program_people()
    {
        return $this->hasMany(InstructorProgramPerson::class);
    }
    public function environment_instructor_programs()
    {
        return $this->hasMany(EnvironmentInstructorProgram::class);
    }
    public function instructor_program_outcomes()
    {
        return $this->hasMany(InstructorProgramOutcome::class);
    }
}