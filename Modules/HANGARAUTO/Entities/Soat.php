<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Soat extends Model {
    use SoftDeletes;
    protected $table = 'Soats';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function Vehicles(){
        return $this->belongsTo(Vehicles::class);
    }
}