<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MovementResponsability extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'movement_id',
        'role',
        'date'
    ];

    protected $dates = [ // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function movement(){ // Accede a la información del movimiento asociado
        return $this->belongsTo(Movement::class);
    }
    public function person(){ // Accede a la información de la persona asociada
        return $this->belongsTo(Person::class);
    }

}
