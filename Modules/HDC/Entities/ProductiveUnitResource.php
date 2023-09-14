<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Resource;
use Modules\SICA\Entities\ProductiveUnit;



class ProductiveUnitResource extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

protected $fillable = [ // Atributos modificables (asignación masiva)
    'resourse_id',
    'productive_unit_id'
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
public function productive_unit(){ // Accede a la unidad productiva al que pertenece
    return $this->belongsTo(ProductiveUnit::class);
}

}
