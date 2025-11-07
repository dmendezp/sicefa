<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Department;

class Country extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = ['name']; // Atributos modificables (asignación masiva)

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Datos para ocultar en una respuesta array o JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function departments(){ // Accede a todos los departamentos asociados a este país
        return $this->hasMany(Department::class);
    }

}
