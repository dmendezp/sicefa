<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\AGROCEFA\Entities\AgriculturalLabor;
use Modules\AGROCEFA\Entities\Consumable;

class Labor extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'activity_id',
        'description',
        'status',
        'observations'
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
    public function executors(){ // Accede a todos los registros de ejecutores que pertenecen a esta responsabilidad
        return $this->hasMany(Executor::class);
    }
    public function agriculturals(){ // Accede a todos los metodos de aplicacion que pertenecen a esta labor
        return $this->hasMany(AgriculturalLabor::class);
    }
    public function consumables(){ // Accede a todos los registros de consumos que pertenecen a esta labor
        return $this->hasMany(Consumable::class);
    }

}
