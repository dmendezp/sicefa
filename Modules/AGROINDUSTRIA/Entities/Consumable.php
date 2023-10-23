<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Inventory;

class Consumable extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'labor_id',
        'inventory_id',
        'amount',
        'price',
    ];
    
    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    //RELACIONES
    public function inventory(){ // Accede a la información del inventario al que pertenece
        return $this->belongsTo(Inventory::class);
    }
    public function labor(){ // Accede a la información de la labor a la que pertenece
        return $this->belongsTo(Labor::class);
    }
}
