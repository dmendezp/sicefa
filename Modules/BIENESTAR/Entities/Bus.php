<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\BIENESTAR\Entities\BusDriver;
use Modules\BIENESTAR\Entities\TransportationAssistance;
use Modules\BIENESTAR\Entities\RouteTransportation;

class Bus extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'buses';

    protected $fillable = [
        'plate',
        'quota',
        'bus_driver_id',
        
    ];

    public function bus_driver(){
    	return $this->belongsTo(BusDriver::class, 'bus_driver_id');
    }

    public function routes_trasportantion(){// Accede a todas las rutas que pertenecen a este Bus
    	return $this->hasMany(RouteTransportation::class, 'bus_id');
    }

    public function transportation_assistances(){// Accede a todas las asistencias que pertenecen a este Bus
    	return $this->hasMany(TransportationAssistance::class, 'bus_id');
    }

   
}
