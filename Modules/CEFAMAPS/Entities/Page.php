<?php

namespace Modules\CEFAMAPS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Environment;

class page extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['name','content','environment_id'];

    public function environment(){
        return $this->belongsTo(Environment::class);
    }
}
