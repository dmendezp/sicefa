<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alliance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'organization',
        'email',
        'phone',
        'start_date',
        'end_date',
        'status',
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\AllianceFactory::new();
    }
}
