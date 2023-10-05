<?php

namespace Modules\BIENESTAR\Entities;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Apprentice;

class Postulations extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'postulations';

    protected $fillable = [
        'apprentice_id',
        'convocation_id',
        'type_of_benefit_id',
        'total_score',
    ];

    

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\PostulationsFactory::new();
    }

     //RELACIONES

     public function answers(){// Accede a los datos de la respuesta al que pertenece
        return $this->hasMany(Answers::class, 'postulation_id');
    }

     public function apprentice(){// Accede a los datos del aprendiz al que pertenece
        return $this->belongsTo(Apprentice::class);
    }

    public function convocation(){// Accede a los datos de la Convocatoria al que pertenece
        return $this->belongsTo(Convocations::class, 'convocation_id');
    }

    public function postulationBenefits(){// Accede a los datos del beneficio que tiene la postulacion al que pertenece
        return $this->hasMany(PostulationsBenefits::class);
    }

    public function socioeconomicsupportfiles(){// Accede a los datos del archivo de soporte al que pertenece
        return $this->hasMany(SocioEconomicSupportFiles::class, 'postulation_id');
    }

    public function typeOfBenefit(){// Accede a los datos del tipo de beneficiario al que pertenece
        return $this->belongsTo(TypesOfBenefits::class, 'type_of_benefit_id');
    }

    

    
}
