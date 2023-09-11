<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class App extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'url',
        'color',
        'icon',
        'description',
        'description_english'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        return $this->attributes['description'] = ucfirst($value);
    }
    public function setDescriptionEnglishAttribute($value){ // Convierte el primer carácter en mayúscula del dato description_english (MUTADOR)
        return $this->attributes['description_english'] = ucfirst($value);
    }

    // RELACIONES
    public function app_productive_units(){ // Accede a todos los registros de las asociaciones entre aplicación y unidad productiva que pertenecen a esta aplicación (PIVOTE)
        return $this->hasMany(AppProductiveUnit::class);
    }
    public function permissions(){ // Accede a todos los permisos que pertenecen a esta aplicación
        return $this->hasMany(Permission::class);
    }
    public function roles(){ // Accede a todos los roles que pertenecen a esta aplicación
        return $this->hasMany(Role::class);
    }
    public function warehouses(){ // Accede a todas las bodegas que pertenecen a esta aplicación
        return $this->hasMany(Warehouse::class);
    }

}
