<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Modules\SICA\Entities\Element;

class Supply extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'element_id',
        'request_external_id',
        'measurement_unit_id',
        'sena_code',
        'amount',
        'observation',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    //RELACIONES
    public function request_external(){ // Accede a la información de la solicitud externa al que pertenece
        return $this->belongsTo(RequestExternal::class);
    }
    public function element(){ // Accede a la información de la solicitud externa al que pertenece
        return $this->belongsTo(Element::class);
    }
}
