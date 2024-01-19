<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\inventories;
use Ñodules\Entities\Fertilizer;


class Fertilizers extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'dosis',
        'cantidad_total',
        'costo_total',
        'metodo_de_aplicaccion',
        'registro_ica',
        'lote',
    ];

    public function inventories(){ // Accede a la información de la unidad productiva y bodega al que pertenece
        return $this->belongsTo(inventories::class);
    }
}

