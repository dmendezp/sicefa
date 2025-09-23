<?php

namespace Modules\GDMF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\TrainingProject;

class MaterialRequest extends Model
{
    use HasFactory;

    protected $fillable = ['training_project_id', 'person_id', 'course_id', 'total','funding_source','from_project','from_production', 'observation'];

    protected static function newFactory()
    {
        return \Modules\GDMF\Database\factories\MaterialRequestFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function training_project()
    {
        return $this->belongsTo(TrainingProject::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function items()
    {
        return $this->hasMany(MaterialRequestItem::class);
    }
}
