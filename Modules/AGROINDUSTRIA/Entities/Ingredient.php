<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Element;
use Modules\AGROINDUSTRIA\Entities\Formulation;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'element_id',
        'amount',
        'formulation_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\AGROINDUSTRIA\Database\factories\IngredientFactory::new();
    }
    //RELACIONES
    public function element(){ // Accede a la información de los elementos usados en la Formula
        return $this->belongsTo(Element::class);
    }
    public function formulation(){ // Accede a la información de los elementos usados en la Formula
        return $this->belongsTo(formulation::class);
    }
}

