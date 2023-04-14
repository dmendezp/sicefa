<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Sector;

class ProductiveUnit extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'name',
        'description',
        'person_id',
        'sector_id',
        'icon'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon (para aprovecha las funciones de formato y manipulación de fecha y hora)

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }

    // RELACIONES
    public function apps(){ // Accede a una o varias aplicaciones asociadas a él (Relación muchos a muchos)
        return $this->belongsToMany(App::class);
    }
    public function sector(){ // Accede a la información del sector al que pertenece
        return $this->belongsTo(Sector::class);
    }
    public function person(){ // Accede a la información de los datos personales del la persona designada como líder
        return $this->belongsTo(Person::class);
    }
    public function warehouses(){ // Accede a una o varias unidades bodegas asociadas a él (Relación muchos a muchos)
        return $this->belongsToMany(Warehouse::class);
    }

}
