<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;


class StaffSenaempresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes, // Borrado suave
    HasFactory; 

    protected $fillable = ['position_company_id', 'apprentice_id', 'image'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\StaffSenaempresaFactory::new();
    }
}