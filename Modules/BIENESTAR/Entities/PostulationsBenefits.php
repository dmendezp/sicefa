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

    //RELACIONES
    
     public function assistancesfoods(){// Accede a todas las asistencias de alimentacion que pertenecen 
    	return $this->hasMany(AssistancesFoods::class, 'postulation_benefit_id');
    }

    public function benefits(){// Accede a los datos del beneficio al que pertenece
        return $this->belongsToMany(Benefits::class, 'benefit_id');
    }
    
    public function postulation(){// Accede a los datos de la postulacion al que pertenece
        return $this->belongsToMany(Postulations::class, 'postulation_id');
    }

    public function transportationassistances(){// Accede a todas las asistencias que pertenecen 
    	return $this->hasMany(TransportationAssistances::class, 'postulation_benefit_id');
    }

   

    

    
}