<?php

namespace Modules\EVS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Election extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','start_date','end_date','status'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    public function juries(){
    	return $this->hasMany(Jury::class);
    }

    public function candidates(){
    	return $this->hasMany(Candidate::class);
    }

    public function authorizeds(){
    	return $this->hasMany(Authorized::class);
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function electeds(){
        return $this->hasMany(Elected::class);
    }

}
