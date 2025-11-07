<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DriverVehicle extends Model
{
    use HasFactory;

    protected $table = 'driver_vehicles';
    protected $fillable = ['driver_id','vehicle_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    
    

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
