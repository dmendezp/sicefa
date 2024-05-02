<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelType extends Model
{
    use HasFactory;

    protected $table = 'fuel_types';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    

    public function fuel_consumptions(){
        return $this->hasMany(FuelConsumption::class);
    }
}
