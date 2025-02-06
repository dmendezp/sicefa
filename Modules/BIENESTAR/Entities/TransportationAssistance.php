<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TransportationAssistance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];



    protected $table = 'transportation_assistances';


    protected $fillable = [
        'assing_transport_route_id',
        'apprentice_id',
        'assistance_status',
        'date_time',
    ];

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\TransportationAssistancesFactory::new();
    }

    //RELACIONES

    public function apprentice(){// Accede a los datos del aprendiz al que pertenece
        return $this->belongsTo(\Modules\SICA\Entities\Apprentice::class, 'apprentice_id');
    }

    public function assigntransportroute(){// Accede a todas las rutas que pertenecen a esta asistencia
    	return $this->belongsTo(AssignTransportRoute::class,'assing_transport_route_id');
    }
}