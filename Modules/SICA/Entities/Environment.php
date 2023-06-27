<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\CEFAMAPS\Entities\Coordinate;
use Modules\CEFAMAPS\Entities\Page;

class Environment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

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

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }

    // RELACIONES
    public function coordinates(){ // Accede a la información del coordinate al que pertenece
        return $this->hasMany(Coordinate::class);
    }

    public function pages(){ // Accede a la información del page al que pertenece
        return $this->hasMany(Page::class);
    }

    public function farm(){ // Accede a la información del farm al que pertenece
        return $this->belongsTo(Farm::class);
    }

    public function productive_unit(){ // Accede a la información del productive_unit al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }

    public function class_environment(){ // Accede a la información del class_environment al que pertenece
        return $this->belongsTo(ClassEnvironment::class);
    }
}
