<?php

namespace Modules\PSERENACEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleEnvironment extends Model
{
    use HasFactory;

    protected $fillable = ['environment1_id', 'courses_id', 'day_of_week', 'start_time', 'end_time'];
    protected $table = 'schedulesenvironments';
    
    protected static function newFactory()
    {
        return \Modules\PSERENACEFA\Database\factories\ScheduleEnvironmentFactory::new();
    }
}
