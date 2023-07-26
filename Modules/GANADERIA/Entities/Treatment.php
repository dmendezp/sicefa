<?php

namespace Modules\GANADERIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Inventory;

class Treatment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'inventory_id',
        'animal_id',
        'date_treatment',
        'dose',
        'name_medicine',
        'observations',
        'person_id'
    ];
    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon
    protected $hidden = ['created_at','updated_at']; // Atributos ocultos para no representarlos en las salidas con formato JSON

    public function inventory() { // Accede a la informacion del inventario de donde se sacan los elementos usados
        return $this->belongsTo(Inventory::class);
    }
    public function animal() { // Accede a la informacion del animal a la cual se le hara el tratamiento
        return $this->belongsTo(Animal::class);
    }
    public function productive_proces() {
        return $this->hasMany(Productive_proces::class);
    }
    public function person(){ // Accede a la información de la persona lider de el tratamiento
        return $this->belongsTo(Person::class);
    }
}
