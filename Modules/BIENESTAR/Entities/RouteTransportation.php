<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\BIENESTAR\Entities\Bus;
use Modules\BIENESTAR\Entities\TransportationAssistance;
use Modules\BIENESTAR\Entities\AssignTransportRoute;

class RouteTransportation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'routes_transportations';

    protected $fillable = [
        'route_number',
        'name_route',
        'stop_bus',
        'arrival_time',
        'departure_time',
        'quota',
        'bus_id',
    ];

    public function bus(){// Accede a todos los buses que pertenecen a esta ruta de transporte
    	return $this->belongsTo(Bus::class, 'bus_id');
    }
    
    public function transportationassistance(){// Accede a todas las asistencias de trasporte que pertenecen a esta ruta de trasporte
    	return $this->hasMany(TransportationAssistance::class, 'route_transportation_id');
    }

    public function assingtransportroutes(){// Accede a todas las asignaciones de trasporte que pertenecen a esta ruta de trasporte
    	return $this->hasMany(AssignTransportRoute::class, 'route_transportation_id');
    }

}