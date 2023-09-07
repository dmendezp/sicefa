<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Benefits extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'benefits';

    protected $fillable = ['name', 'porcentege'];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\BenefitsFactory::new();
    }

    //RELACIONES

    public function benefitstypesofbenefits(){// Accede a los datos del beneficiario y el beneficio al que pertenece
        return $this->hasMany(BenefitsTypesOfBenefits::class,'benefit_id');
    }
    
    public function postulationBenefits(){// Accede a los datos del beneficio que tiene la postulacion al que pertenece
        return $this->hasMany(PostulationsBenefits::class);
    }

    
}
