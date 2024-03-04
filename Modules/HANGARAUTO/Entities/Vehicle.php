<?php
 
namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
 
use Illuminate\Database\Eloquent\Model;
 
class Vehicle extends Model
{
    use SoftDeletes;
    protected $table = 'vehicles';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];



    public function soats(){
        return $this->hasMany(Soat::class);
    }

    public function tecnomecanics(){
        return $this->hasMany(Tecnomecanic::class);
    }

    public function fuel_consumptions(){
        return $this->hasMany(FuelConsumption::class);
    }

    public function petition_assignments(){
        return $this->hasMany(PetitionAssignment::class);
    }

    public function vehicle_type(){
        return $this->belongsTo(VehicleType::class);
    }

    
}