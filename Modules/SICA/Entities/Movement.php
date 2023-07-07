<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Movement extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'registration_date',
        'return_date',
        'movement_type_id',
        'voucher_number',
        'price',
        'observation',
        'state'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objeto Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setObservationAttribute($value){ // Convierte el primer carácter en mayúscula del dato observation (MUTADOR)
        $this->attributes['observation'] = ucfirst($value);
    }

    // RELACIONES
    public function movement_details(){ // Accede a todos los detalles de movimiento que pertenecen a este movimiento
        return $this->hasMany(MovementDetail::class);
    }
    public function movement_responsibilities(){ // Accede a todos los registros de responsables de movimiento que le pertenecen a este movimiento
        return $this->hasMany(MovementResponsibility::class);
    }
    public function movement_type(){ // Accede al tipo de movimiento al que pertenece
        return $this->belongsTo(MovementType::class);
    }
    public function warehouse_movements(){ // Accede a todos los movimientos de bodega que pertenecen a este movimiento
        return $this->hasMany(WarehouseMovement::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\MovementFactory::new();
    }

}
