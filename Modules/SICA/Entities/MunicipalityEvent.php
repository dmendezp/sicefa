<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MunicipalityEvent extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masiva)
        'person_id',
        'municipality_id',
        'event_type'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function municipality(){ // Accede a la información del municipio al que pertenece
        return $this->belongsTo(Municipality::class);
    }
    public function person(){ // Accede a la información de la persona al que pertenece
        return $this->belongsTo(Person::class);
    }

}
