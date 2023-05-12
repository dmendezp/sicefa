<?php

namespace Modules\CEFAMAPS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Environment;

class Coordinate extends Model
{
    use SoftDeletes;

    protected $fillable = ['length','latitude','environment_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function environments(){
        return $this->belongsTo(Environment::class);
    }
}
