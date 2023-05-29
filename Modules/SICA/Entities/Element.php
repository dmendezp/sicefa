<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Element extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    use HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'measurement_unit_id',
        'description',
        'kind_of_purchase_id',
        'category_id',
        'price',
        'UNSPSC_code',
        'image',
        'slug'
    ];

    protected $dates = [ // Atributos que deben ser tratados como objetos Carbon (para aprovechar las funciones de formato y manipulación de fecha y hora)
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // FUNCIONES INTERNAS
    public function getRouteKeyName(){ // Establece el dato que se muestra cuando este elemento pretende ser llamado desde una ruta
        return 'slug';
    }

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name y genera el slug para la ruta amigable del modelo (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value, '-'); // Generación del slug
    }
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }

    // RELACIONES
    public function measurement_unit(){ // Accede a la información de unidad de medidad asociada
        return $this->belongsTo(MeasurementUnit::class);
    }
    public function kind_of_purchase(){ // Accede a la información del tipo de compra asociada
        return $this->belongsTo(KindOfPurchase::class);
    }
    public function category(){ // Accede a la información de la categoría asociada
        return $this->belongsTo(Category::class);
    }
    public function inventories(){ // Accede a todos los registros de inventarios que están relacionados con este elemento
        return $this->hasMany(Inventory::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\ElementFactory::new();
    }

}
