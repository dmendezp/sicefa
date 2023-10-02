<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Executor;

class EmployementType extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    public function executors(){
        return $this->hasMany(Executor::class);
    }
}
