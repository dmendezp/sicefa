<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutesTransportations extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_number',
        'name_route',
        'stop_bus',
        'arrival_time',
        'departure_time',
        'bus_id',
    ];
    

}
