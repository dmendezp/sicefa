<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;

class Vivero extends Model
{
    protected $fillable = ['name', 'location', 'description'];
}