<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Inventory;

class Loan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory;

    protected $fillable = ['apprentice_id', 'inventory_id', 'start_datetime', 'end_datetime', 'state'];


    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\LoanFactory::new();
    }
    public function apprentice()
    { // Accede a la información del aprendiz
        return $this->belongsTo(Apprentice::class);
    }
    public function inventory()
    { // Accede a la información del inventario
        return $this->belongsTo(Inventory::class);
    }
}
