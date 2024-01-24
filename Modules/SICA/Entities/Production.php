<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Production extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'labor_id',
        'element_id',
        'amount',
        'expiration_date',
        'lot_number',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    //RELACIONES
    public function labor(){ // Accede a la información de la labor a la que pertenece
        return $this->belongsTo(Labor::class);
    }
    public function element(){ // Accede a la información de los elementos al que pertenece
        return $this->belongsTo(Element::class);
    }
}
