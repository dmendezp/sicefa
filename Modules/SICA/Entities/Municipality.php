<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Department;
use Modules\CPD\Entities\Village;

class Municipality extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function getCouDepMunAttribute(){
        return $this->department->country->name.' - '.$this->department->name.' - '.$this->name;
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function villages(){
        return $this->hasMany(Village::class);
    }

}
