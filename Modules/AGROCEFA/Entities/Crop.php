<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use Modules\AGROCEFA\Entities\Variety;
use Modules\SICA\Entities\Labor;
use OwenIt\Auditing\Contracts\Auditable;

class Crop extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
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
        return $this->belongsToMany(Environment::class, 'crop_environments'); // Asegúrate de que coincida con el nombre de tu tabla
    }                                               

    
    public function labors(){
        return $this->belongsToMany(Labor::class, 'crop_labors');
    }
    



}



