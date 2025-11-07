<?php

namespace Modules\BIENESTAR\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class AssignTransportRoute extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at','update_at'];

    protected $table = 'assing_transport_routes';
    
    protected $fillable = [
        'apprentice_id',
        'route_transportation_id',
        'convocation_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AssingTransportRoutesFactory::new();
    }

    //RELACIONES
    public function apprentice(){// Accede a los datos del aprendiz al que pertenece
        return $this->belongsTo(\Modules\SICA\Entities\Apprentice::class, 'apprentice_id');
    }

    public function convocations(){// Accede a todas las convocatorias que pertenecen a esta asignacion            
    	return $this->belongsTo(PostulationBenefit::class, 'postulation_benefit_id');
    }

    public function routes_trasportantion(){// Accede a todas las rutas que pertenecen a esta asignacion            
    	return $this->belongsTo(RouteTransportation::class, 'route_transportation_id');
    }

    

    
}
