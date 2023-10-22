<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Quarter;

class Convocation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'convocations';


    protected $fillable = [
        'name',
        'description',
        'food_quotas',
        'transport_quotas',
        'start_date',
        'end_date',
        'quarter_id',
    ];
    
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\ConvocationsFactory::new();
    }
    //RELACIONES

    public function assingtransportroutes(){// Accede a todas las asignaciones de trasporte que pertenecen a esta ruta de trasporte
    	return $this->hasMany(AssingTransportRoute::class, 'convocation_id');
    }

    public function convocationsquestions(){// Accede a los datos de las preguntas de la convocatoria al que pertenece
        return $this->hasMany(ConvocationQuestion::class, 'convocation_id');
    }

    public function postulation(){// Accede a los datos de la postulacion al que pertenece
        return $this->hasMany(Postulations::class, 'postulation_id');
    }
    public function quarters(){
    	return $this->belongsTo(Quarter::class, 'quarters_id');
    }
    

    

    

}
