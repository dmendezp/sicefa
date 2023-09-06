<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PostulationsBenefits extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'postulations_benefits';

    protected $fillable = [
        'benefit_id',
        'postulation_id',
        'state',
        'message',
    ];

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\PostulationsBenefitsFactory::new();
    }

    public function benefit(){// Accede a los datos del beneficio al que pertenece
        return $this->belongsToMany(Benefits::class);
    }
    
    public function postulation(){// Accede a los datos de la postulacion al que pertenece
        return $this->belongsToMany(Postulations::class);
    }

    public function transportationassistances(){// Accede a todas las asistencias que pertenecen a este Bus
    	return $this->hasMany(TransportationAssistances::class);
    }

    public function assistancesfoods(){// Accede a todas las asistencias que pertenecen a este Bus
    	return $this->hasMany(AssistancesFoods::class);
    }


    

    
}
