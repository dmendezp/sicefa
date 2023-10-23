<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'labor_id',
        'inventory_id',
        'amount',
        'price',
    ];
    
    //RELACIONES
    public function labor(){ // Accede a la información de la labor a la que pertenece
        return $this->belongsTo(Labor::class);
    }
    public function inventory(){ // Accede a la información de la persona a la que pertenece
        return $this->belongsTo(Inventory::class);
    }
}
