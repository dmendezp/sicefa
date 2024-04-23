<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\learningOutcome;


class InstructorProgram extends Model
{
    use HasFactory;

    protected $fillable = ['person_id','environment_id','course_id','learning_outcome_id','state','date','start_time','end_time'];

    protected $hidden = ['created_at','updated_at'];

    public function attendances (){
        return $this->hasMany(Attendance::class);
    }
    public function attendance_apprentices()
    {
        return $this->hasMany(AttendanceApprentice::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function learning_outcome()
    {
        return $this->belongsTo(learningOutcome::class);
    }
}