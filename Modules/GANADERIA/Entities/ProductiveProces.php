<?php

namespace Modules\GANADERIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\GANADERIA\Entities\Machinery;
use Modules\GANADERIA\Entities\Treatment;
use Modules\GANADERIA\Entities\Milking;
use Modules\GANADERIA\Entities\Fertilization;
use Modules\GANADERIA\Entities\Reproduction;
use Modules\GANADERIA\Entities\Mortalitie;
use Modules\GANADERIA\Entities\Human_talent;
use Modules\SICA\Entities\Warehouse;

class Productive_proces extends Model
{
    use SoftDeletes;

    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    
    public function machinery() {
        return $this->belongsTo(Machinery::class);
    }
    
    public function treatments() {
        return $this->belongsTo(Treatment::class);
    }

    public function milkings() {
        return $this->hasMany(Milking::class);
    }

    public function fertilizations() {
        return $this->hasMany(Fertilization::class);
    }

    public function reproductions() {
        return $this->hasMany(Reproduction::class);
    }

    public function mortalities() {
        return $this->hasMany(Mortalitie::class);
    }

    public function humantalent() {
        return $this->hasMany(Human_talent::class);
    }

    public function warehouses() {
        return $this->belongsTo(Warehouse::class);
    }
}
