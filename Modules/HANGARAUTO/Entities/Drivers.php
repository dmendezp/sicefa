<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;

class Driver extends Model {
    use SoftDeletes;
    protected $table = 'Drivers';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function vehicles(){
        return $this->hasMany('Modules\HANGARAUTO\Entities\Vehicles');
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }
}