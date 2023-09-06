<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class BusDrivers extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    
    protected $table = 'bus_drivers';


    /**
     * NOTE: se implementa relacion con conductores 
     * */
    public function buses(){
    	return $this->hasMany(Buses::class);
    }
}
