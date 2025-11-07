<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetitionAssignment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['petition_id','driver_id','vehicle_id'];
    protected $hidden = ['created_at','updated_at'];
    

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function petition(){
        return $this->belongsTo(Petition::class);
    }
}
