<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Event;

class EventAttendance extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['event_id','person_id','date'];

    public function people(){
        return $this->belongsTo(Person::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }    

}
