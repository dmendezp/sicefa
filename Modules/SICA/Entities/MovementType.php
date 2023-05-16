<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MovementType extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'consecutive'
    ];

    protected $dates = [ // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formto y manipulación de fecha y hora)
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Capitalización de palabras del dato name (MUTADOR)
        $this->attributes['name'] = ucwords(strtolower($value));
    }

}
