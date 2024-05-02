<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\MeasurementUnit;

class FuelConsumption extends Model
{
    use SoftDeletes;
    protected $table = 'fuel_consumptions';
    protected $fillable = ['vehicle_id','fuel_type_id','date','measurement_unit_id','price','amount','mileage','person_id'];
    protected $hidden = ['created_at','updated_at'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    public function person(){
        return $this->belongsTo(Person::class);
    }
    public function measurement_unit(){
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function fuel_type(){
        return $this->belongsTo(FuelType::class);
    }
}
