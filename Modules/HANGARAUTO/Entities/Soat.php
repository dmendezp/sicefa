<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;

class Soat extends Model {
    use SoftDeletes;
    protected $table = 'Soats';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    public function person(){
        return $this->belongsTo(Person::class);
    }
}