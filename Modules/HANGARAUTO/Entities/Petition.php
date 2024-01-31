<?php

namespace Modules\HANGARAUTO\Entities;
use Iluminate\Database\Eloquent\SoftDeletes;

use Iluminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Municipality;

class Petition extends Model {
    use SoftDeletes;
    protected $table = 'Petitions';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }
}