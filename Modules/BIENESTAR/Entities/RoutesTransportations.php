<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutesTransportations extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_number',
    ];
    

}
