<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Farm extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }
}
