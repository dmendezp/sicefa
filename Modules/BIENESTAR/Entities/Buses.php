<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Buses extends Model
{
    use HasFactory;
    
    protected $hidden = ['created_at','update_at'];

    protected $fillable = [
        'plate',
        'quota',
        'bus_driver_id',
    ];

    public function bus_driver(){
    	return $this->belongsTo(BusDrivers::class);
    }
}
