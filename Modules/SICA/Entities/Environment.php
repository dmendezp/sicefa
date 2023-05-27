<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

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
        'farms_id',
        'productive_units_id',
        'status',
        'type_environment',
        'class_environments_id'
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
    public function coordinate(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->hasMany(Coordinate::class);
    }

    public function page(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->hasMany(Page::class);
    }

    public function farms(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->belongsTo(Farm::class);
    }

    public function productive_units(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->belongsTo(ProductiveUnit::class);
    }

    public function class_environments(){ // Accede a todos los elementos que pertenecen a esta categoría
        return $this->belongsTo(ClassEnvironment::class);
    }
}
