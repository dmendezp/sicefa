<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Labor;

class Consumable extends Model
{


    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\AGROCEFA\Database\factories\ConsumableFactory::new();
    }

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

     // RELACIONES
     public function labor(){ // Accede a la información de la labor al que pertenece
        return $this->belongsTo(Labor::class);
    }
    public function inventory(){ // Accede a la información del inventario al que pertenece
        return $this->belongsTo(Inventory::class);
    }
    
}
