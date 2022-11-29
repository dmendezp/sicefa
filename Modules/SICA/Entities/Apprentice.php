<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Asistencia;

class Apprentice extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['person_id','course_id','apprentice_status','guardian','guardian_telephone'];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function asistencias(){
        return $this->belongsToMany(Asistencia::class, 'apprentice_asistencias')->withTimestamps()->withPivot('asistencia','id');
    }

    public function getCursoyProgramaNameAttribute(){
        return $this->Course->Program->name.' - '.$this->Course->code;
    }

    public function getCodeCursoAttribute(){
        return $this->course->code;
    }

    public function apprenticeattendances(){
        return $this->belongsTo(ApprenticeAsistenica::class, 'apprentice_asistenicas');
    }

    
}
