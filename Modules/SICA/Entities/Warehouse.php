<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Warehouse extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'description',
        'app_id'
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
    public function app(){ // Accede a la información de la aplicación asociada
        return $this->belongsTo(App::class);
    }
    public function productive_units(){ // Accede a una o varias unidades productivas asociadas a él (Relación muchos a muchos)
        return $this->belongsToMany(ProductiveUnit::class);
    }
    public function inventories(){ // Accede a todos los registro de inventarios que están relacionados con esta bodega
        return $this->hasMany(Inventory::class);
    }
    public function warehouse_movements(){ // Accede a todos los registros de movimientos de bodega que esten asociados con esta bodega
        return $this->hasMany(WarehouseMovement::class);
    }

}
