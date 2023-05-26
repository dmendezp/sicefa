<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class App extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'url',
        'color',
        'icon',
        'description'.
        'description_english'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)

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
    public function productive_units(){ // Accede a una o varias unidades productivas asociadas a él (Relación muchos a muchos)
        return $this->belongsToMany(ProductiveUnit::class);
    }
    public function warehouses(){ // Accede a todas las bodegas que usa esta aplicación
        return $this->hasMany(Warehouse::class);
    }
    public function roles(){
        return $this->hasMany(Role::class);
    }
    public function permissions(){
        return $this->hasMany(Permission::class);
    }

}
