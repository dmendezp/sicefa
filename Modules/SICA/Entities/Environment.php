<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CEFAMAPS\Entities\Coordinate;
use Modules\CEFAMAPS\Entities\Page;

class Environment extends Model
{
    use SoftDeletes;
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function coordinates(){
        return $this->hasMany(Coordinate::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }
}
