<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\TestFactory::new();
    }
}
