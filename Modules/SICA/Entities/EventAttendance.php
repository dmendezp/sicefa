<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Event;

class EventAttendance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['event_id','person_id','date'];

    public function people(){
        return $this->belongsTo(Person::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }   

}
