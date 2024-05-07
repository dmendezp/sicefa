<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Person;

class Formulation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes, // Borrado suave
    HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'name',
        'element_id',
        'person_id',
        'productive_unit_id',
        'proccess',
        'amount',
        'date',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

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
        return $this->hasMany(Utensil::class);
    }
    public function ingredients(){ // Accede a todos las formulaciones de una unidad productiva
        return $this->hasMany(Ingredient::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\CAFETO\Database\factories\FormulationFactory::new();
    }

}

