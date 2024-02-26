<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Municipality;
use OwenIt\Auditing\Contracts\Auditable;

class Petition extends Model implements Auditable {
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes; // Borrado suave

    protected $fillable = [
        'start_date', 
        'end_date',
        'municipality_id',
        'reason',
        'numstudents',
        'vehicle_type_id',
        'person_id',
        'observation',
        'status',
        
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function vehicle_type(){
        return $this->belongsTo(VehicleType::class);
    }

    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }
    

    public function petition_assignments(){
        return $this->hasMany(PetitionAssignment::class);
    }
}