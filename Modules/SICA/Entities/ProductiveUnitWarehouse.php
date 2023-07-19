<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductiveUnitWarehouse extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'productive_unit_id',
        'warehouse_id'
    ];

    // RELACIONES
    public function productive_unit(){ // Accede a la unidad productiva al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }
    public function warehouse(){ // Accede a la bodega al que pertenece
        return $this->belongsTo(Warehouse::class);
    }

}
