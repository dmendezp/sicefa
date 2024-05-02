<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;

class Driver extends Model {
    use SoftDeletes;
    protected $table = 'drivers';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function driver_vehicles(){
        return $this->hasMany(DriverVehicle::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function petition_assignments(){
        return $this->hasMany(PetitionAssignment::class);
    }

    
}