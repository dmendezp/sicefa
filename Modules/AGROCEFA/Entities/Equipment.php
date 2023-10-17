<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Inventory;



class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';


    protected $fillable = [
        'labor_id',
        'inventory_id',
        'amount',
        'price'
    ];
    
    public function labor() {
        return $this->belongsTo(Labor::class,);
    }
    public function inventory(){
        return $this->belongsTo(Inventory::class,);
    }
}
