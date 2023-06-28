<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Executor extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'person_id',
        'labor_id',
        'responsibility_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function labor(){ // Accede a la información de la labor al que pertenece
        return $this->belongsTo(Labor::class);
    }
    public function person(){ // Accede a la información de la persona al que pertenece
        return $this->belongsTo(Person::class);
    }
    public function responsibility(){ // Accede a la información de la responsabilidad al que pertenece
        return $this->belongsTo(Responsibility::class);
    }

}
