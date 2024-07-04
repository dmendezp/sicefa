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
        'route_transportation_id',
        'apprentice_id',
        'postulation_benefit_id',
        'bus_id',
        'bus_driver_id',
        'porcentenge',
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

    public function buses(){// Accede a todos los buses que pertenecen a esta asistencia
    	return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function bus_driver(){// Accede a todos los conductores que pertenecen a esta asistencia
    	return $this->belongsTo(BusDriver::class, 'bus_driver_id');
    }

    public function postulationBenefits(){// Accede a los datos del beneficio que tiene la postulacion al que pertenece
        return $this->belongsTo(PostulationBenefit::class, 'postulation_benefit_id');
    }


    public function routes_trasportantion(){// Accede a todas las rutas que pertenecen a esta asistencia
    	return $this->belongsTo(RouteTransportation::class, 'route_transportation_id');
    }

    
}
