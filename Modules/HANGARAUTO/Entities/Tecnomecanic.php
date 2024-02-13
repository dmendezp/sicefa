<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;

class Tecnomecanic extends Model {
    use SoftDeletes;
    protected $table = 'technomechanics';
    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at','updated_at'];

    public function person(){
        return $this->belongsTo(Person::class);
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    
}