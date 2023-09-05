<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Variety;
use Modules\SICA\Entities\Environment;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    public function variety(){
        return $this->belongsTo(Variety::class);}
        
    public function environments(){
        return $this->belongsToMany(Environment::class);}
}
