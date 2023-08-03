<?php

namespace Modules\BOLMETEOR\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    use SoftDeletes;
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    public function values(){
    	return $this->hasMany(Value::class);
    }

    public function climaticdata(){
    	return $this->hasMany(Climaticdata::class);
    }
}
