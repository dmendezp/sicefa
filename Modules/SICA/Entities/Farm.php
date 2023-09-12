<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Farm extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'description',
        'area',
        'person_id',
        'municipality_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }

    // RELACIONES
    public function environments(){ // Accede a todos los ambientes de formación que pertenecen a esta granja
        return $this->hasMany(Environment::class);
    }
    public function municipality(){ // Accede al municipio al que pertenece
        return $this->belongsTo(Municipality::class);
    }
    public function person(){ // Accede a la información de la persona líder de esta granja
        return $this->belongsTo(Person::class);
    }
    public function productive_units(){ // Accede a todos las unidades productivas pertenecen a esta granja
        return $this->hasMany(ProductiveUnit::class);
    }

}
