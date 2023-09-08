<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utensil extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\AGROINDUSTRIA\Database\factories\UtensilFactory::new();
    }
}
