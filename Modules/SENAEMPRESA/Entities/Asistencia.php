<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Apprentice;
use Illuminate\Database\Eloquent\softDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Asistencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    /* protected $fillable = ['date','guardado']; sin full calendar title*/ 
    protected $fillable = ['guardado','title','start','end']; /* con full calendar 
                                                        title, start, end 
                                                        (start y end son necesarias 
                                                        para tener hora de inicio y fin de la actividad 
                                                        aunque sin ellas y solo con date funciona perso sin horarios) */
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\AsistenciaFactory::new();
    }

    public function apprentices(){
        return $this->belongsToMany(Apprentice::class, 'apprentice_attendances')->withTimestamps()->withPivot('asistencia','id','work_id');
    }


    
    public function getasistenciasNombreCursoAttribute(){
        return $this->Apprentice->Course->Program->name.'-'.$this->Apprentice->course_id;
    }

    public function getCourseIdAttribute(){
        return $this->apprentices->course_id;
    }

   

    
   
    
}
