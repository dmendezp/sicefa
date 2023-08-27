<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class senaempresa extends Model
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes, // Borrado suave
    HasFactory; 

    protected $fillable = ['name', 'description','quarters_id'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\SenaempresaFactory::new();
    }
}
