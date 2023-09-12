<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Buses extends Model implements Auditable
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
    	return $this->belongsTo(BusDrivers::class, 'bus_driver_id');
    }

    public function routes_trasportantion(){// Accede a todas las rutas que pertenecen a este Bus
    	return $this->hasMany(RoutesTransportations::class);
    }

    public function transportation_assistances(){// Accede a todas las asistencias que pertenecen a este Bus
    	return $this->hasMany(TransportationAssistances::class);
    }

   
}
