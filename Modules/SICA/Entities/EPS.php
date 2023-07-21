<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Person;

class EPS extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimiento de cambios reaizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = ['name']; // Atributos modificables (asignación masiva)

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convertir a mayúsculas el valor del dato name (MUTADOR)
        $this->attributes['name'] = mb_strtoupper($value);
    }

    // RELACIONES
    public function people(){ // Accede a todas las personas asociadas a esta eps
        return $this->hasMany(Person::class, 'eps_id'); // Se especifica el campo origen de la relación en la tabla people
    }

}
