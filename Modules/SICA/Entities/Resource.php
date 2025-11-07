<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Resource extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    protected $fillable = ['name']; // Atributos modificables (asignación masiva)

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function environmental_aspects(){ // Accede a todos los aspectos ambientales que pertenecen a este recurso
        return $this->hasMany(EnvironmentalAspect::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($personEnvironmentalAspect) {
            $familyPersonFootprint = $personEnvironmentalAspect->familyPersonFootprint;
            if ($familyPersonFootprint) {
                $familyPersonFootprint->delete();
            }
        });
    }

}
