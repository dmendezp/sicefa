<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\AGROCEFA\Entities\Tool;
use Modules\AGROCEFA\Entities\Equipment;
use Modules\AGROINDUSTRIA\Entities\Consumable;

class Inventory extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'productive_unit_warehouse_id',
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

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objeto Carbon

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
    public function consumables(){ // Accede a todos los consumibles que pertenecen a este inventario
        return $this->hasMany(Consumable::class);
    }
    public function element(){ // Accede a la información de elemento al que pertenece
        return $this->belongsTo(Element::class);
    }
    public function equipments(){ // Accede a todos los equipos que pertenecen a este inventario
        return $this->hasMany(Equipment::class);
    }
    public function movement_details(){ // Accede a todos los detalles de movimiento que pertenecen a este inventario
        return $this->hasMany(MovementDetail::class);
    }
    public function person(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Person::class);
    }
    public function productive_unit_warehouse(){ // Accede a la información de la unidad productiva y bodega al que pertenece
        return $this->belongsTo(ProductiveUnitWarehouse::class);
    }
    public function tools(){ // Accede a todas las herramientas que pertenecen a este inventario
        return $this->hasMany(Tool::class);
    }


    // configuración de fcoty para la generació de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\InventoryFactory::new();
    }
}
