<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Contractor extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'supervisor_id',
        'contract_number',
        'contract_year',
        'contract_start_date',
        'contract_end_date',
        'total_contract_value',
        'contractor_type_id',
        'contract_object',
        'contract_obligations',
        'amount_hours',
        'assigment_value',
        'sesion',
        'sesion_date',
        'employee_type_id',
        'SIIF_code',
        'insurer_entity_id',
        'policy_number',
        'policy_issue_date',
        'policy_approval_date',
        'policy_effective_date',
        'policy_expiration_date',
        'risk_type',
        'state',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setContractObjectAttribute($value){ // Convierte el primer carácter en mayúscula del dato contract_object (MUTADOR)
        $this->attributes['contract_object'] = ucfirst($value);
    }
    public function setContractObligationsAttribute($value){ // Convierte el primer carácter en mayúscula del dato contract_obligations (MUTADOR)
        $this->attributes['contract_obligations'] = ucfirst($value);
    }
    public function setRiskTypeAttribute($value){ // Convertir a mayúsculas el valor del dato risk_type (MUTADOR)
        $this->attributes['risk_type'] = mb_strtoupper($value);
    }
    public function setSesionAttribute($value){ // Capitalización de palabras del dato sesion (MUTADOR)
        $this->attributes['sesion'] = ucwords(strtolower($value));
    }

    // RELACIONES
    public function contractor_type(){ // Accede al tipo de contratación al que pertenece
        return $this->belongsTo(ContractorType::class);
    }
    public function employee_type(){ // Accede al tipo de empleado al que pertenece
        return $this->belongsTo(EmployeeType::class);
    }
    public function insurer_entity(){ // Accede a la entidad aseguradora al que pertenece
        return $this->belongsTo(InsurerEntity::class);
    }
    public function person(){ // Accede a la información de la persona al que pertenece
        return $this->belongsTo(Person::class);
    }
    public function supervisor(){ // Accede a la información del supervisor asignado
        return $this->belongsTo(Person::class, 'supervisor_id');
    }

}
