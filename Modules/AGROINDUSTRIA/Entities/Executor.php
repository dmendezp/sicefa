<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Person;

class Executor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'labor_id',
        'person_id',
        'employement_type_id',
        'amount',
        'price',
    ];
    
    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    //RELACIONES
    public function employement_type(){ // Accede a la información del tipo de empleado al que pertenece
        return $this->belongsTo(EmployementType::class);
    }
    public function labor(){ // Accede a la información de la labor a la que pertenece
        return $this->belongsTo(Labor::class);
    }
    public function person(){ // Accede a la información de la persona a la que pertenece
        return $this->belongsTo(Person::class);
    }
}
