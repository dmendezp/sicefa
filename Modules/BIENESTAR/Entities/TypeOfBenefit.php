<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class TypeOfBenefit extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

   
    protected $fillable = [
        'name',
    ];

    // Define el nombre de la tabla en la base de datos
    protected $table = 'types_of_benefits';
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\TypesOfBenefitsFactory::new();
    }


    //RELACIONES

    public function benefitstypesofbenefits(){// Accede a los datos del beneficiario y el beneficio al que pertenece
        return $this->hasMany(BenefitsTypesOfBenefits::class, 'type_of_benefit_id');
    }
    public function postulation(){// Accede a los datos de la postulacion al que pertenece
        return $this->hasMany(Postulations::class, 'postulation_id');
    }

    
}
