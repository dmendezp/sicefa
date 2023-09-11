<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Resource extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'measurement_unit_id',
        'status',
        'cpf_coefficient'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function labor_resources(){ // Accede a todos los registros de recursos de labor que pertenecen a este recurso
        return $this->hasMany(LaborResource::class);
    }
    public function measurement_unit(){ // Accede a la unidad de medida al que pertenece
        return $this->belongsTo(MeasurementUnit::class);
    }

}
