<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Employee extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'contract_number',
        'contract_date',
        'professional_card_number',
        'professional_card_issue_date',
        'employee_type_id',
        'position_id',
        'risk_type',
        'bonding'.
        'state'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setRiskTypeAttribute($value){ // Convertir a mayúsculas el valor del dato risk_type (MUTADOR)
        $this->attributes['risk_type'] = mb_strtoupper($value);
    }

    // RELACIONES
    public function employee_type(){ // Accede al tipo de empleado al que pertenece
        return $this->belongsTo(EmployeeType::class);
    }
    public function person(){ // Accede a la información de la persona al que pertenece
        return $this->belongsTo(Person::class);
    }
    public function position(){ // Accede al normograma salarial al que pertenece
        return $this->belongsTo(Position::class);
    }

}
