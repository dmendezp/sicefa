<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Oildate extends Model {
    use SoftDeletes;
    protected $table = 'Oildates';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
}