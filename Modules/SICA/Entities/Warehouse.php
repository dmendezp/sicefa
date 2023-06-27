<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\GANADERIA\Entities\Productive_proces;

class Warehouse extends Model implements Auditable
{
<<<<<<< HEAD
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['code','star_date','end_date','program-id','deschooling'];

    public function productive_proces() {
        return $this->hasMany(Productive_proces::class);
    }
=======

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'description',
        'app_id'
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
    public function app(){ // Accede a la información de la aplicación al que pertenece
        return $this->belongsTo(App::class);
    }
    public function inventories(){ // Accede a todos los registros de inventarios que le pertenecen a esta bodega
        return $this->hasMany(Inventory::class);
    }
    public function productive_units(){ // Accede a una o varias unidades productivas asociadas a él (Relación muchos a muchos)
        return $this->belongsToMany(ProductiveUnit::class);
    }
    public function warehouse_movements(){ // Accede a todos los movimientos de bodega que pertenecen a esta bodega
        return $this->hasMany(WarehouseMovement::class);
    }

>>>>>>> 66f4c04502d915b8977a7de7506bf87ecf0b5caa
}
