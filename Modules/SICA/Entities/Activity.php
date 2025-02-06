<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\EnvironmentalAspect;
use OwenIt\Auditing\Contracts\Auditable;

class Activity extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'name',
        'productive_unit_id',
        'activity_type_id',
        'description',
        'period',
        'status'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }
    public function setPeriodAttribute($value){ // Convierte el primer carácter en mayúscula del dato period (MUTADOR)
        $this->attributes['period'] = ucfirst($value);
    }

    // RELACIONES
    public function activity_type(){ // Accede a la información del tipo de actividad al que pertenece
        return $this->belongsTo(ActivityType::class);
    }
    public function environmental_aspects(){ // Accede todos los aspectos ambientales que pertenecen a esta actividad (PIVOTE)
        return $this->belongsToMany(EnvironmentalAspect::class)->withTimestamps();
    }
    public function labors(){ // Accede a todas las labores que pertenecen a esta actividad
        return $this->hasMany(Labor::class);
    }
    public function productive_unit(){ // Accede a la información de la unidad productiva al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }
    public function responsibilities(){ // Accede a todas los registros de responsabilidades que pertenecen a esta actividad
        return $this->hasMany(Responsibility::class);
    }

}
