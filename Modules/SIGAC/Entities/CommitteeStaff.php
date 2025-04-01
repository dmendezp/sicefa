<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;

class CommitteeStaff extends Model
{
    use HasFactory;

    protected $table = 'committee_staffs';

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\CommitteeStaffFactory::new();
    }

    public function person(){
        
        return $this->belongsTo(Person::class);
    }
}
