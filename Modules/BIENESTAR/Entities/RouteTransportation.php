<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

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
        'bus_id',
    ];

    public function bus(){// Accede a todos los buses que pertenecen a esta ruta de transporte
    	return $this->belongsTo(Buses::class, 'bus_id');
    }
    
    public function transportationassistance(){// Accede a todas las asistencias de trasporte que pertenecen a esta ruta de trasporte
    	return $this->hasMany(TransportationAssistance::class, 'route_transportation_id');
    }

    public function assingtransportroutes(){// Accede a todas las asignaciones de trasporte que pertenecen a esta ruta de trasporte
    	return $this->hasMany(AssingTransportRoute::class, 'route_transportation_id');
    }

}
