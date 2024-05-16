<?php

namespace Modules\PQRS\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypePqrs extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masiva)
        'name'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    
    // RELACIONES
    public function pqrs(){ // Accede a todas las pqrs que pertenecen a este tipo de pqrs
        return $this->hasMany(Pqrs::class);
    }
}
