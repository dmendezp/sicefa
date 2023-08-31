<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Crop;

class Variety extends Model
{
    use HasFactory;

    public function crops(){
        return $this->hasMany(Crop::class);
    }
    
}
