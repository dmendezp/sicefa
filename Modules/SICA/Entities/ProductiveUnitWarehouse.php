<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ProductiveUnitWarehouse extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'productive_unit_id',
        'warehouse_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function cash_counts(){ // Accede a todas las sesiones de caja asociados a esta unidad productiva y bodega
        return $this->hasMany(CashCount::class);
    }
    public function inventories(){ // Accede a todos los inventarios asociados a esta unidad productiva y bodega
        return $this->hasMany(Inventory::class);
    }
    public function productive_unit(){ // Accede a la unidad productiva al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }
    public function warehouse(){ // Accede a la bodega al que pertenece
        return $this->belongsTo(Warehouse::class);
    }
    public function warehouse_movements(){ // Accede a todos los movimientos de bedega asociados a esta unidad productiva y bodega
        return $this->hasMany(WarehouseMovement::class);
    }

}
