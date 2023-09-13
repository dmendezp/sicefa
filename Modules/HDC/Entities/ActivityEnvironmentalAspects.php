<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\HDC\Http\Controllers\EnvironmentalAspectActivityController;
use Modules\SICA\Entities\Activity;
use OwenIt\Auditing\Contracts\Auditable;


class ActivityEnvironmentalAspects extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

protected $fillable = [ // Atributos modificables (asignación masiva)
    'activity_id',
    'environmental_aspect_id'
];

protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
    'created_at',
    'updated_at'
];

// RELACIONES
public function activity(){ // Accede a la actividad a la que pertenece
    return $this->belongsTo(Activity::class);
}
public function environmental_aspect(){ // Accede al aspecto ambiental al que pertenece
    return $this->belongsTo(EnvironmentalAspect::class);
}
}
