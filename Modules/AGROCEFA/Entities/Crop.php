<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use Modules\AGROCEFA\Entities\Variety;
use Modules\SICA\Entities\Labor;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sown_area',
        'seed_time',
        'density',
        'variety_id',
        'finish_date',
    ];

    public function variety(){
        return $this->belongsTo(Variety::class);
    }

    public function environments(){
        return $this->belongsToMany(Environment::class);
    }
    
    public function labors(){
        return $this->belongsToMany(Labor::class);
    }
    



}



