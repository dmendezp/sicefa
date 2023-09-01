<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutesTransportations extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_number',
<<<<<<< HEAD
=======
        'name_route',
        'stop_bus',
        'arrival_time',
        'departure_time',
        'bus_id',
>>>>>>> 0724d1b96c37bc46dd6f5b3c56e7a87709e83c10
    ];
    

}
