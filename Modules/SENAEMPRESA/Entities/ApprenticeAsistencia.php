<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/* use Modules\SICA\Entities\Apprentice;
use Modules\SENAEMPRESA\Entities\Asistencia;*/
use Illuminate\Database\Eloquent\SoftDeletes; 

class ApprenticeAsistencia extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['asistencia','apprentice_id','asistencia_id'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\ApprenticeAttendanceFactory::new();
    }

    /* public function apprentice(){
        return $this->belongsTo(Apprentice::class);
    } 
    public function asistencia(){
        return $this->belongsTo(Asistencia::class);
    }    */

    
}
