<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\Crop;
use Modules\SICA\Entities\Environment;

class CropEnvironment extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_id',
        'environment_id'
    ];

    // RELACIONES
    public function crop(){
        return $this->belongsTo(Crop::class);
    }

    public function environment(){
        return $this->belongsTo(Environment::class);
    }
}
