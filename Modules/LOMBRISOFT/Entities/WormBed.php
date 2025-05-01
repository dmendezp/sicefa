<?php

namespace Modules\LOMBRISOFT\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WormBed extends Model
{
    use HasFactory;
protected $table = 'wormsBeds';
    protected $fillable = [
        'number',
        'status',
        'start_date'
    ];

    protected static function newFactory()
    {
        return \Modules\LOMBRISOFT\Database\factories\WormBedFactory::new();
    }
}

