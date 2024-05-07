<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\HDC\Entities\ProductiveUnitResource;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\AGROCEFA\Entities\Specie;
use Modules\AGROINDUSTRIA\Entities\Formulation;

class ProductiveUnit extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'name',
        'description',
        'icon',
        'person_id',
        'sector_id',
        'farm_id'
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
    public function activities(){ // Accede a todas las actividades que pertenecen a esta unidad productiva
        return $this->hasMany(Activity::class);
    }
    public function app_productive_units(){ // Accede a todos los registros de las asociaciones entre aplicación y unidad productiva que pertenecen a esta unidad productiva (PIVOTE)
        return $this->hasMany(AppProductiveUnit::class);
    }
    public function environment_productive_units(){ // Accede a todos los registros de las asociaciones de ambientes y unidades productivas que pertenecen a esta unidad productiva
        return $this->hasMany(EnvironmentProductiveUnit::class);
    }
    public function farm(){ // Accede a la información de la finca al que pertenece
        return $this->belongsTo(Farm::class);
    }
    public function formulations(){ // Accede a todos los registros de las formulaciones que pertenecen a esta unidad productiva
        return $this->hasMany(Formulation::class);
    }
    public function person(){ // Accede a la información de la persona lider de esta unidad productiva
        return $this->belongsTo(Person::class);
    }
    public function productive_unit_warehouses(){ // Accede a todos los registros de unidad productiva y bodega que pertenecen a esta unidad productiva
        return $this->hasMany(ProductiveUnitWarehouse::class);
    }
    public function roles(){ // Accede a todos los roles que pertenecen a esta unidad productiva (PIVOTE)
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function sector(){ // Accede a la información del sector al que pertenece
        return $this->belongsTo(Sector::class);
    }
    public function species(){ // Accede a la informacion de la especie a la que pertenece
        return $this->hasMany(Specie::class);
    }
}
