<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EnvironmentalAspectLabor extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'environmental_aspect_id',
        'labor_id',
        'amount',
        'price'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function environmental_aspect(){ // Accede al aspecto ambiental al que pertenece
        return $this->belongsTo(EnvironmentalAspect::class);
    }
    public function labor(){ // Accede a la labor al que pertenece
        return $this->belongsTo(Labor::class);
    }

}
