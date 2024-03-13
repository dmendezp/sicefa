<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SENAEMPRESA\Entities\Senaempresa;
use Modules\SICA\Entities\Course;

class CourseSenaempresa extends Model
{
    protected $fillable = ['course_id', 'senaempresa_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'update_at'];
    protected $table = 'course_senaempresa';
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\CourseSenaempresaFactory::new();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sompanyenaempresa()
    {
        return $this->belongsTo(Senaempresa::class);
    }
}
