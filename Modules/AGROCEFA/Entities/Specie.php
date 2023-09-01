<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Variety;


class Specie extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\AGROCEFA\Database\factories\SpecieFactory::new();
    }

    public function varieties(){ // Accede a todos los movimientos de bedega asociados a esta unidad productiva y bodega
        return $this->hasMany(Variety::class);
    }
}
