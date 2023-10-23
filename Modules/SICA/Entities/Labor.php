<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\AGROCEFA\Entities\AgriculturalLabor;
use Modules\AGROCEFA\Entities\Crop;
use Modules\AGROCEFA\Entities\Tool;
use Modules\AGROCEFA\Entities\Executor;
use Modules\AGROCEFA\Entities\Equipment;


class Labor extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'activity_id',
        'person_id',
        'planning_date',
        'execution_date',
        'description',
        'price',
        'status',
        'observations',
        'destination'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function activity(){ // Accede a la información de la actividad al que pertenece
        return $this->belongsTo(Activity::class);
    }
    public function environmental_aspect_labors(){ // Accede a todos los registros de la asociación entre aspectos ambientales y labores que pertenecen a esta labor
        return $this->hasMany(EnvironmentalAspectLabor::class);
    }
    public function person(){ // Accede a la información de la persona responsable de la ejecución de la labor
        return $this->belongsTo(Person::class);
    }
    public function agricultural_labors(){ // Accede a todos los registros de recursos de labor que pertenecen a esta labor
        return $this->hasMany(AgriculturalLabor::class);
    }
    public function crops(){
        return $this->belongsToMany(Crop::class);//relacion de muchos a muchos entre labors y crops
    }
    public function tools(){
    return $this->hasMany(Tool::class);
    }
    public function crop(){
        return $this->belongsToMany(Crop::class);
    }
    public function executors(){
        return $this->hasMany(Executor::class, 'labor_id');
    }
    public function equipment(){
        return $this->hasMany(Equipment::class,);
    }

    
    

}