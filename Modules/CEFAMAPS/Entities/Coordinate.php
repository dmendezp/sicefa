<?php

namespace Modules\CEFAMAPS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Environment;

class Coordinate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes;

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'length',
        'latitude',
        'environment_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function environment(){ // Accede a la información del environment al que pertenece
        return $this->belongsTo(Environment::class);
    }
}
