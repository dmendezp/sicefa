<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventSia extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id', 'name', 'imagen_evento', 'location', 'start_date', 'end_date',
        'organizer', 'contact_email', 'contact_phone', 'status'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\EventSiaFactory::new();
    }
}
