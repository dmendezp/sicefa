<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;
use OwenIt\Auditing\Contracts\Auditable;

class FamilyPersonFootprint extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [
        'carbon_print',
        'mes',
        'anio',
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function personenvironmentalaspects()
    {
        return $this->hasMany(PersonEnvironmentalAspect::class, 'family_person_footprint_id');
    }

    // ELIMINACIÓN EN CASCADA
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($familyPersonFootprint) {
            $familyPersonFootprint->personenvironmentalaspects()->delete();
        });
    }
}
