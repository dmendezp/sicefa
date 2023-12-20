<?php

namespace Modules\HANGARAUTO\Entities;
use Iluminate\Database\Eloquent\SoftDeletes;

use Iluminate\Database\Eloquent\Model;

class Reference extends Model {
    use SoftDeletes;
    protected $table = 'References';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function Vehicles(){
        return $this->hasMany('Modules\HANGARAUTO\Entities\Vehicles');
    }
}