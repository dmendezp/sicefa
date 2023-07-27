<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class WarehouseMovement extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'productive_unit_warehouse_id',
        'movement_id',
        'role'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function movement(){ // Accede a la información del movimiento al que pertenece
        return $this->belongsTo(Movement::class);
    }
    public function productive_unit_warehouse(){ // Accede a la información de la unidad productiva y bodega al que pertenece
        return $this->belongsTo(ProductiveUnitWarehouse::class);
    }

}
