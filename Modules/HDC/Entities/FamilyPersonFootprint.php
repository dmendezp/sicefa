<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;
use OwenIt\Auditing\Contracts\Auditable;

class FamilyPersonFootprint extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'carbon_print'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function person(){ // Accede a la persona al que pertenece
        return $this->belongsTo(Person::class);
    }
    public function personenvironmentalaspects(){ // Accede a todas los registros de aspectos ambientales y actividades que pertenecen a esta actividad
        return $this->hasMany(PersonEnvironmentalAspect::class);
    }

}
