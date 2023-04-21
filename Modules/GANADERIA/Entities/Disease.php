<?php

namespace Modules\GANADERIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\GANADERIA\Database\factories\DiseaseFactory::new();
    }
}
