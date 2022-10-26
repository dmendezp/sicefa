<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Apprentice;
use Illuminate\Database\Eloquent\softDeletes;

class Asistencia extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['asistencia','date'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\AsistenciaFactory::new();
    }

    public function apprentices(){
        return $this->belongsToMany(Apprentice::class);
    }
    
    public function getasistenciasNombreCurso(){
        return $this->Apprentice->Course->Program->name.'-'.$this->Apprentice->course_id;
    }
    
}
