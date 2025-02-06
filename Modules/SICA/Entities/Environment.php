<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\CEFAMAPS\Entities\Coordinate;
use Modules\CEFAMAPS\Entities\Page;
use Modules\AGROCEFA\Entities\Crop;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\EnvironmentInstructorProgram;

class Environment extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'picture',
        'description',
        'length',
        'latitude',
        'farm_id',
        'status',
        'type_environment',
        'class_environment_id'
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

    // RELACIONES
    public function academic_programmings(){ // Accede a todos los registros de programaciones academicas asociadas a este ambiente de formación
        return $this->hasMany(AcademicProgramming::class);
    }
    public function class_environment(){ // Accede a la información de la clase de ambiente de formación al que pertenece
        return $this->belongsTo(ClassEnvironment::class);
    }
    public function coordinates(){ // Accede a la información del coordinate al que pertenece
        return $this->hasMany(Coordinate::class);
    }
    public function environment_instructor_programs(){
        return $this->hasMany(EnvironmentInstructorProgram::class);
    }
    public function environment_productive_units(){ // Accede a todos los registros de las asociaciones de ambientes y unidades productivas que pertenecen a este ambiente
        return $this->hasMany(EnvironmentProductiveUnit::class);
    }
    public function farm(){ // Accede a la información de la granja al que pertenece
        return $this->belongsTo(Farm::class);
    }
    public function pages(){ // Accede a la información del page al que pertenece
        return $this->hasMany(Page::class);
    }
    public function crops(){
        return $this->belongsToMany(Crop::class);
    }


}
