<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\CEFAMAPS\Entities\Coordinate;
use Modules\CEFAMAPS\Entities\Page;

class Environment extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'picture',
        'description',
        'length',
        'latitude',
        'farm_id',
        'productive_unit_id',
        'status',
        'type_environment',
        'class_environment_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }

    // RELACIONES
    public function class_environment(){ // Accede a la información de la clase de ambiente de formación al que pertenece
        return $this->belongsTo(ClassEnvironment::class);
    }
    public function coordinates(){ // Accede a la información del coordinate al que pertenece
        return $this->hasMany(Coordinate::class);
    }
    public function farm(){ // Accede a la información de la granja al que pertenece
        return $this->belongsTo(Farm::class);
    }
    public function pages(){ // Accede a la información del page al que pertenece
        return $this->hasMany(Page::class);
    }
    public function productive_unit(){ // Accede a la información de la unidad productiva al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }

}
