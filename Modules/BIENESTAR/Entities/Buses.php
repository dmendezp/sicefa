<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Buses extends Model implements Auditable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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
