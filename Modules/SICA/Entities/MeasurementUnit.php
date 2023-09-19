<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\AGROINDUSTRIA\Entities\Supply;

class MeasurementUnit extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'minimum_unit_measure',
        'conversion_factor',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setMinimumUnitMeasureAttribute($value){ // Convierte el primer carácter en mayúscula y el resto en minúsculas del dato minimum_unit_measure (MUTADOR)
        $this->attributes['minimum_unit_measure'] = ucfirst(strtolower($value));
    }
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula y el resto en minúsculas del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    // RELACIONES
    public function elements(){ // Accede a todos los elementos que pertenecen a esta unidad de medida
        return $this->hasMany(Element::class);
    }
    public function environmental_aspects(){ // Accede a todos los aspectos ambientales que pertenecen a esta unidad de medida
        return $this->hasMany(EnvironmentalAspect::class);
    }
    public function supplies(){ // Accede a todos los registros de recursos que pertenecen a esta unidad de medida
        return $this->hasMany(Supply::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\MeasurementUnitFactory::new();
    }

}
