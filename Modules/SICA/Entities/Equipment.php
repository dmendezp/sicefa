<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Equipment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $table = 'equipments';

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