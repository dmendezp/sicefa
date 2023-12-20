<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Tecnomecanic extends Model {
    use SoftDeletes;
    protected $table = 'Tecnomecanics';
    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at','updated_at'];

    public function Vehicle(){
        return $this->belongsTo(Vehicles::class);
    }
}