<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class BusDrivers extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    


    /**
     * NOTE: se implementa relacion con conductores 
     * */

     //RELACIONES
     
    public function buses(){// Accede a todos los buses que pertenecen a este conductor
    	return $this->hasMany(Buses::class);
    }

    public function transportation_assistance(){// Accede a todas las asistencias de trasporte que pertenecen a este conductor
    	return $this->hasMany(TransportationAssistances::class);
    }


}
