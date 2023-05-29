<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Movement extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    use HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'registration_date',
        'return_date',
        'movement_type_id',
        'voucher_number',
        'price',
        'observation',
        'state'
    ];

    protected $dates = [ // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)
        'registration_date',
        'return_date',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setObservationAttribute($value){ // Convierte el primer carácter en mayúscula del dato observation (MUTADOR)
        $this->attributes['observation'] = ucfirst($value);
    }

    // RELACIONES
    public function movement_type(){ // Accede a la información del tipo de movimiento asociado
        return $this->belongsTo(MovementType::class);
    }
    public function movement_details(){ // Accede a todos los registros de detalles de movimiento que esten asociados con este movimiento
        return $this->hasMany(MovementDetail::class);
    }
    public function movement_responsabilities(){ // Accede a todos los registros de responsables de movimiento que esten asociados con este movimiento
        return $this->hasMany(MovementResponsability::class);
    }
    public function warehouse_movements(){ // Accede a todos los registros de movimientos de bodega que esten asociados con este movimiento
        return $this->hasMany(WarehouseMovement::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\MovementFactory::new();
    }

}
