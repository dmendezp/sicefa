<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Inventory;



class Tool extends Model
{
    public function labor(){
        return $this->belongsTo(Labor::class);
    }
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

}
