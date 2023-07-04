<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Department;
use Modules\CPD\Entities\Village;

class Municipality extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'department_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Datos para ocultar en una respuesta array o JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function getCouDepMunAttribute(){ // Obtener el nombre del país + departamento + municipio (ACCESOR)
        return $this->department->country->name.' - '.$this->department->name.' - '.$this->name;
    }

    // RELACIONES
    public function department(){ // Accede a la información del departamento al que pertenece
        return $this->belongsTo(Department::class);
    }
    public function farms(){ // Accede a todas las granjas que pertenecen a este municipio
        return $this->hasMany(Farm::class);
    }
    public function municipality_events(){ // Accede a todos los registros de eventos en municipios que le pertenecen a este municipio
        return $this->hasMany(MunicipalityEvent::class);
    }
    public function villages(){
        return $this->hasMany(Village::class);
    }

}
