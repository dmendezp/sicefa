<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Quarter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Senaempresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory;

    protected $fillable = ['name', 'description', 'quarter_id'];

    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\SenaempresaFactory::new();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_senaempresa');
    }
    public function quarter()
    {
        return $this->belongsTo(Quarter::class);
    }
}
