<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Warehouse extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['code','star_date','end_date','program-id','deschooling'];
}
