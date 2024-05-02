<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Modules\SICA\Entities\Course;

class CourseVacancy extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory;

    protected $fillable = ['course_id', 'vacancy_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'update_at'];
    protected $table = 'course_vacancy';
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\CourseVacancyFactory::new();
    }


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
