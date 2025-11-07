<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Course;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vacancy extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory;

    protected $fillable = ['name', 'image', 'description_general', 'requirement', 'senaempresa_id', 'position_company_id', 'start_datetime', 'end_datetime', 'state'];

    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\VacancyFactory::new();
    }


    public function Course()
    {
        return $this->hasMany(Course::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function senaempresa()
    { //Accede a Senaempresa registrados
        return $this->belongsToMany(Senaempresa::class);
    }

    public function positionCompany()
    {
        return $this->belongsTo(PositionCompany::class, 'position_company_id');
    }
}
