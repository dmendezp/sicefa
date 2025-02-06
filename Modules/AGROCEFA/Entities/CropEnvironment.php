<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entitites\Environment;
use OwenIt\Auditing\Contracts\Auditable;

class CropEnvironment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $table = 'crop_environments';

    protected $fillable = [
        'crop_id',
        'environment_id'
    ];

    public function environment(){ // Accede al ambiente al que pertenece
        return $this->belongsTo(Environment::class);
    }
    public function crop(){ // Accede a la unidad productiva al que pertenece
        return $this->belongsTo(Crop::class);
    }
}
