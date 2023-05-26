<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Inventory extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD

    use SoftDeletes; // Borrado suave

    use HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'warehouse_id',
        'element_id',
        'destination',
        'description',
        'price',
        'amount',
        'stock',
        'production_date',
        'lot_number',
        'expiration_date',
        'state',
        'mark',
        'inventory_code'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objeto Caron (para aprovechar las funcines de formato y manipulación de fecha y hora)

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // ACESORES Y MUTADORES
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }
    public function setMarkAttribute($value){ // Convierte el primer carácter en mayúscula del dato mark (MUTADOR)
        $this->attributes['mark'] = ucfirst($value);
    }

    // RELACIONES
    public function element(){ // Accede a la información de elemento asociado
        return $this->belongsTo(Element::class);
    }
    public function warehouse(){ // Accede a la información de la bodega asociada
        return $this->belongsTo(Warehouse::class);
    }
    public function person(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Person::class);
    }
    public function movement_details(){ // Accede a todos los registros de detalle de movimientos que esten asociados con este inventario
        return $this->hasMany(MovementDetail::class);
    }


    // configuración de fcoty para la generació de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\InventoryFactory::new();
    }
}
