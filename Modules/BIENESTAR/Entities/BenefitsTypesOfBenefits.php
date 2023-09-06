<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BenefitsTypesOfBenefits extends Model

{
    use HasFactory, SoftDeletes;

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
    public function benefit()
    {
        return $this->belongsTo(Benefits::class, 'benefit_id');
    }

    public function typeOfBenefit()
    {
        return $this->belongsTo(TypesOfBenefits::class, 'type_of_benefit_id');
    }
}
