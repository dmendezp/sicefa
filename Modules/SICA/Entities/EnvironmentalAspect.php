<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\HDC\Entities\PersonEnvironmentalAspect;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Activity;

class EnvironmentalAspect extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'resource_id',
        'measurement_unit_id',
        'aspect_type',
        'conversion_factor',
        'personal',
        'state'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }

    // RELACIONES
    public function activities(){ // Accede a todas las actividades que pertenecen a este aspecto ambiental (PIVOTE)
        return $this->belongsToMany(Activity::class)->withTimestamps();
    }
    public function environmental_aspect_labors(){ // Accede a todos los registros de la asociación entre aspectos ambientales y labores que pertenecen a este aspecto ambiental
        return $this->hasMany(EnvironmentalAspectLabor::class);
    }
    public function resource(){ // Accede al recurso al que pertenece
        return $this->belongsTo(Resource::class);
    }
    public function measurement_unit(){ // Accede a la unidad de medida al que pertenece
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function personenvironmentalaspects(){ // Accede a la unidad de medida al que pertenece
        return $this->hasMany(PersonEnvironmentalAspect::class);
    }

}
