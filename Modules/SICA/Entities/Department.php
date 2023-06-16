<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Municipality;

class Department extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'country_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Datos para ocultar en una respuesta array o JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function country(){ // Accede a la información del pais al que pertenece
        return $this->belongsTo(Country::class);
    }
    public function municipalities(){ // Accede a todos los municipios asociados a este departamento
        return $this->hasMany(Municipality::class);
    }

}
