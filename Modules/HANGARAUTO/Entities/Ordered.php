<?php

namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model {
    use SoftDeletes;
    protected $table = 'Requests';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
}