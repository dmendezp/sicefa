<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{
    use HasFactory;

    protected $table = 'vehicle_types';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
