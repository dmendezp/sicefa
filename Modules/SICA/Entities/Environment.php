<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CEFAMAPS\Entities\Coordinate;
use Modules\CEFAMAPS\Entities\Page;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ClassEnvironment;

class Environment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = [
        'name',
        'picture',
        'description',
        'length',
        'latitude',
        'farms_id',
        'productive_units_id',
        'status',
        'type_environment',
        'class_environments_id'
    ];

    public function coordinates(){
        return $this->hasMany(Coordinate::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }

    public function farms(){
        return $this->belongsTo(Farm::class);
    }

    public function productive_units(){
        return $this->belongsTo(ProductiveUnit::class);
    }

    public function class_environments(){
        return $this->belongsTo(ClassEnvironment::class);
    }
}
