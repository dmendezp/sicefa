<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Crop;
use Modules\AGROCEFA\Entities\Specie;
use OwenIt\Auditing\Contracts\Auditable;


class Variety extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = [
        'name',
        'specie_id'
    ];

    public function crops(){
        return $this->hasMany(Crop::class);
    }
    

    public function specie(){ // Accede a la información de la unidad productiva y bodega al que pertenece
        return $this->belongsTo(Specie::class);
    }
}

