<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Person;

class Formulation extends Model
{
    use HasFactory;

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'name',
        'element_id',
        'proccess',
        'amount',
        'date',
        'productive_unit_id',
        'person_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\AGROINDUSTRIA\Database\factories\FormulationFactory::new();
    }
    //RELACIONES
    public function element(){ // Accede a la información de los elementos usados en la Formula
        return $this->belongsTo(Element::class);
    }
    public function productive_unit(){ // Accede a la información de la unidad productiva al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }
    public function person(){ // Accede a la información de la persona lider de esta unidad productiva
        return $this->belongsTo(Person::class);
    }
    public function utensils(){ // Accede a todos las formulaciones de una unidad productiva
        return $this->hasMany(Utensils::class);
    }
    public function ingredients(){ // Accede a todos las formulaciones de una unidad productiva
        return $this->hasMany(Ingredients::class);
    }
}

