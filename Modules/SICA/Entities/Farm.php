<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Farm extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [
        'name',
        'description',
        'area',
        'person_id',
        'municipality_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)

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
    public function person(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->belongsTo(Person::class);
    }

    public function municipality(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->belongsTo(Municipality::class);
    }

    public function productive_unit(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->hasMany(ProductiveUnit::class);
    }
}
