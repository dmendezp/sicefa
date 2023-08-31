<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class benefits extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'porcentege'];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\BenefitsFactory::new();
    }
}
