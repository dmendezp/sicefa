<?php

namespace Modules\EVS\Entities;
use Modules\SICA\Entities\Person;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Jury extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    public function election(){
    	return $this->belongsTo(Election::class);
    }

    public function person(){
    	return $this->belongsTo(Person::class);
    }

    public function Authorizeds(){
        return $this->hasMany(Authorized::class);
    }
}
