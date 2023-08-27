<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class position_company extends Model
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes, // Borrado suave
    HasFactory; 

    protected $fillable = ['requirement', 'description', 'state', 'activo', 'inactivo'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\PositionCompanyFactory::new();
    }
}
