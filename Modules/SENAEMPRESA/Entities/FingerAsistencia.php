<?php

namespace Modules\SENAEMPRESA\Entities;

use Modules\SICA\Entities\Person;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class FingerAsistencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['person_id','area','date_turn','time_in','time_exit','hours_work'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\FingerAsistenciaFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
