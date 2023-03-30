<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeasurementUnit extends Model
{

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'minimum_unit_measure',
        'conversion_factor',
    ];

    protected $dates = [ // Asignación de fechas
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula y el resto en minúsculas del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst(strtolower($value));
    }
    public function setMinimumUnitMeasureAttribute($value){ // Convierte el primer carácter en mayúscula y el resto en minúsculas del dato minimum_unit_measure (MUTADOR)
        $this->attributes['minimum_unit_measure'] = ucfirst(strtolower($value));
    }

    // RELACIONES
    public function elements(){ // Accede a todos los elementos que pertenecen a esta unidad de medida
        return $this->hasMany(Element::class);
    }

}
