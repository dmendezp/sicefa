<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Course;


class InstructorProgram extends Model
{
    use HasFactory;

    public function attendances (){
        return $this->hasMany(Attendance::class);
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
}