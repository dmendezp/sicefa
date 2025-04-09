<?php

namespace Modules\SIA\Entities\App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = ['name', 'color', 'icon', 'description', 'description_english', 'url'];
}