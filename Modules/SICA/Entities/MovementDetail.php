<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MovementDetail extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'movement_id',
        'inventory_id',
        'amount',
        'price'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objeto Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function inventory(){ // Accede a la información del inventario al que pertenece
        return $this->belongsTo(Inventory::class);
    }
    public function movement(){ // Accede a la información del movimiento al que pertence
        return $this->belongsTo(Movement::class);
    }

}
