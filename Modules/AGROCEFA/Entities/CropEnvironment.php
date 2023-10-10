<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CropEnvironment extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_id',
        'environment_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\AGROCEFA\Database\factories\CropEnvironmentFactory::new();
    }
}
