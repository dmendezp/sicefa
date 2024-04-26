<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Check extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id', 
        'driver_id',
        'date',
        'initial_kilometer',
        'final_kilometer',
        'initial_hour',
        'final_hour',

        
    ];
    protected $table = 'checks';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function check_lists(){
        return $this->hasMany(CheckList::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    
}
