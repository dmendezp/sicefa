<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Resource;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\HDC\Entities\FamilyPersonFootprint;


class PersonEnvironmentalAspect extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

protected $fillable = [ // Atributos modificables (asignación masiva)
    'environmental_aspect_id',
    'family_person_footprint_id',
    'valor_consumo'
];

protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
    'created_at',
    'updated_at'
];

// RELACIONES}
public function environmentalaspect(){ // Accede a la unidad Huella familiar al que pertenece
    return $this->belongsTo(EnvironmentalAspect::class);
}
public function familypersonfootprints(){ // Accede a la unidad Huella familiar al que pertenece
    return $this->hasMany(FamilyPersonFootprint::class);
}


}