<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Course;

class Program extends Model
{

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['name','network_id','program_type','sofia_code'];
    
    public function courses(){
        return $this->hasMany(Course::class);
    }
}
