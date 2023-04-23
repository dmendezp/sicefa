<?php

namespace Modules\GANADERIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use SoftDeletes;

    protected $fillable = ['mother', 'weight', 'sex', 'color', 'location'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
}
