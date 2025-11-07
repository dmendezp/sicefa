<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MovementResponsibility extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'movement_id',
        'role',
        'date'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objeto Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function movement(){ // Accede a la información del movimiento al que pertenece
        return $this->belongsTo(Movement::class);
    }
    public function person(){ // Accede a la información de la persona al que pertenece
        return $this->belongsTo(Person::class);
    }

}
