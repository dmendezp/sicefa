<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class EmployeeType extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = ['name','price','year']; // Atributos modificables (asignación masiva)

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }

    // RELACIONES
    public function contractors(){ // Accede a todos los registros de contratistas que le pertenecen a este tipo de empleado
        return $this->hasMany(Contractor::class);
    }
    public function employees(){ // Accede a todos los registros de empleados que le pertenecen a este tipo de empleado
        return $this->hasMany(Employee::class);
    }
    public function executors(){ // Accede a todos los ejecutores que le pertenecen a este tipo de empleado
        return $this->hasMany(Executor::class);
    }

}
