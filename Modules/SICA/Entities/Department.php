<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Municipality;

class Department extends Model
{
    use SoftDeletes;
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function municipalities(){
        return $this->hasMany(Municipality::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

}
