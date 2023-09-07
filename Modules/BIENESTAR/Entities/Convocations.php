<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Convocations extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'convocations';


    protected $fillable = [
        'title',
        'start_date',
        'end_date',
    ];
    
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\ConvocationsFactory::new();
    }
    //RELACIONES

    public function assingtransportroutes(){// Accede a todas las asignaciones de trasporte que pertenecen a esta ruta de trasporte
    	return $this->hasMany(AssingTransportRoutes::class);
    }

    public function convocationsquestions(){// Accede a los datos de las preguntas de la convocatoria al que pertenece
        return $this->hasMany(ConvocationQuestion::class);
    }

    public function postulation(){// Accede a los datos de la postulacion al que pertenece
        return $this->hasMany(Postulations::class, );
    }

    

    

}
