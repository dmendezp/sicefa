<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Element extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

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

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // FUNCIONES INTERNAS
    public function getRouteKeyName(){ // Establece el dato que se muestra cuando este elemento pretende ser llamado desde una ruta
        return 'slug';
    }

    // MUTADORES Y ACCESORES
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }

    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name y genera el slug para la ruta amigable del modelo (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value, '-'); // Generación del slug
    }
    // RELACIONES
    public function category(){ // Accede a la categoría al que pertenece
        return $this->belongsTo(Category::class);
    }
    public function inventories(){ // Accede a todos los registros de inventarios que le pertenecen a este elemento
        return $this->hasMany(Inventory::class);
    }
    public function kind_of_purchase(){ // Accede al tipo de compra al que pertenece
        return $this->belongsTo(KindOfPurchase::class);
    }
    public function measurement_unit(){ // Accede a la unidad de medida al que pertence
        return $this->belongsTo(MeasurementUnit::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\ElementFactory::new();
    }

}
