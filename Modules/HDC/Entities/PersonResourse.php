<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Resource;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\HDC\Entities\FamilyPersonFootprint;


class PersonResourse extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

protected $fillable = [ // Atributos modificables (asignación masiva)
    'resourse_id',
    'family_person_footprint_id'
];

protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
    'created_at',
    'updated_at'
];

// RELACIONES
public function resourse(){ // Accede al recurso al que pertenece
    return $this->belongsTo(Resource::class);
}
public function family_person_footprint(){ // Accede a la unidad Huella familiar al que pertenece
    return $this->belongsTo(FamilyPersonFootprint::class);
}

}
