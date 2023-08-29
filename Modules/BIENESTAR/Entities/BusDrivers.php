<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusDrivers extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected $table = 'bus_drivers';


    /**
     * NOTE: se implementa relacion con conductores 
     * */
    public function buses(){
    	return $this->hasMany(Buses::class);
    }
}
