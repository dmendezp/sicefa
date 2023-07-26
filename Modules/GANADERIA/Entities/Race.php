<?php

namespace Modules\GANADERIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Race extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
}
