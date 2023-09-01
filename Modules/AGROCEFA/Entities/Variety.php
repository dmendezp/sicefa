<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< Updated upstream
use Modules\AGROCEFA\Entities\Crop;
=======
use Modules\AGROCEFA\Entities\Specie;

>>>>>>> Stashed changes

class Variety extends Model
{
    use HasFactory;

    public function crops(){
        return $this->hasMany(Crop::class);
    }
    

    public function specie(){ // Accede a la información de la unidad productiva y bodega al que pertenece
        return $this->belongsTo(Specie::class);
    }
}

