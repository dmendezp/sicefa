<?php

namespace Modules\EVS\Entities;
use Modules\SICA\Entities\Person;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Authorized extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    public function person(){
    	return $this->belongsTo(Person::class);
    }

    public function election(){
    	return $this->belongsTo(Election::class);
    }

    public function jury(){
        return $this->belongsTo(Jury::class);
    }

}
