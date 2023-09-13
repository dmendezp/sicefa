<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Resource;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Activity;


class EnvironmentalAspect extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'resource_id',
        'aspect_type',
        'conversion_factor',
        'personal',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    // Relación: Un aspecto ambiental puede tener muchos registros de "personal aspectos"
    public function personenvironmentalaspects(){
        return $this->hasMany(PersonEnvironmentalAspect::class);
    }
    public function resource(){ // Accede al recurso al que pertenece
        return $this->belongsTo(Resource::class);
    }

    public function activities(){
        return $this->belongsToMany(Activity::class);
    }

}
