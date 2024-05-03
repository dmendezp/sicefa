<?php

namespace Modules\AGROCEFA\Entities;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AgriculturalLabor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD
    use HasFactory;

    protected $fillable = [
        'labor_id',
        'application_method',
        'objective',
    ];
    
    protected static function newFactory()
    {
        return \Modules\AGROCEFA\Database\factories\AgriculturalLaborFactory::new();
    }

    public function labor(){ // Accede a todas las labores que pertenecen a esta actividad
        return $this->hasMany(Labor::class);
    }
}
