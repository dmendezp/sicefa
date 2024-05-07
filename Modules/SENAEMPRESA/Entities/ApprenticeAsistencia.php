<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Apprentice;
use Modules\SENAEMPRESA\Entities\Asistencia;
use Modules\SENAEMPRESA\Entities\Work;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ApprenticeAsistencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['asistencia','apprentice_id','attendance_id','work_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\ApprenticeAttendanceFactory::new();
    }

     public function apprentice(){
        return $this->belongsTo(Apprentice::class);
    } 
    public function asistencia(){
        return $this->belongsTo(Asistencia::class);
    }
    
    /* public function works(){
        return $this->belongsToMany(Work::class, 'apprentice_attendance_works')->withTimestamps();
    } */
    
    public function work(){
        return $this->belongsTo(Work::class);
    }
    
}
