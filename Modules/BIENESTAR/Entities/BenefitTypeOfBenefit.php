<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class BenefitTypeOfBenefit extends Model implements Auditable

{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    // Especifica la tabla asociada al modelo
    protected $table = 'benefits_types_of_benefits'; // Reemplaza 'nombre_de_la_tabla' por el nombre real
    
    // Especifica los campos que pueden ser asignados masivamente
    protected $fillable = [
        'benefit_id',
        'type_of_benefit_id',
        // Agrega aquí otros campos si los tienes en la tabla
    ];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\BenefitsTypesOfBenefitsFactory::new();
    }

    //RELACIONES

    
    public function benefits(){// Accede a los datos del beneficio al que pertenece
        return $this->belongsTo(Benefit::class,'benefit_id');
    }

    public function typeOfBenefits(){// Accede a los datos del beneficiario al que pertenece
        return $this->belongsTo(TypeOfBenefit::class,'type_of_benefit_id');
    }
}
