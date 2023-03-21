<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'kind_of_property'
    ];

    protected $dates = [ // Asignación de fechas
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer caracter en mayúscula y el resto en minúsculas del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    // RELACIONES
    public function elements(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->hasMany(Element::class);
    }

}
