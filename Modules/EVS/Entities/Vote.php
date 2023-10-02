<?php

namespace Modules\EVS\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    public function candidate(){
    	return $this->belongsTo(Candidate::class);
    }

    public function election(){
        return $this->belongsTo(Election::class);
    }

}
