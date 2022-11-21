<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;

class Event extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'state'
    ];


    public function people(){
        return $this->belongsToMany(Person::class, 'event_attendances')->withTimestamps();
    }
}
