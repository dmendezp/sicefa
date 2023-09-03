<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Inventory;
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
    public function Apprentice()
    { // Accede a la información del aprendiz 
        return $this->belongsTo(Apprentice::class);
    }
    public function Invetory()
    { // Accede a la información del aprendiz 
        return $this->belongsTo(Inventory::class);
    }
}
