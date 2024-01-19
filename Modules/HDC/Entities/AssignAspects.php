<?php

namespace Modules\HDC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignAspects extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\HDC\Database\factories\AssignAspectsFactory::new();
    }
}
