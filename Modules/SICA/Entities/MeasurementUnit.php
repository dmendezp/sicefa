<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MeasurementUnit extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    use HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'minimum_unit_measure',
        'conversion_factor',
    ];

    protected $dates = [ // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)
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


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\MeasurementUnitFactory::new();
    }

}
