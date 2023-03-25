<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Element extends Model
{

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'measurement_unit_id',
        'description',
        'kind_of_purchase_id',
        'categorie_id',
        'UNSPSC_code',
        'image',
        'slug'
    ];

    protected $dates = [ // Asignación de fechas
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // FUNCIONES INTERNAS
    public function getRouteKeyName(){ // Establece el dato que se muestra cuando este elemento pretende ser llamado desde una ruta
        return 'slug';
    }

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }
    public function setDescriptionAttribute($value){ // Convierte el primer carácter en mayúscula del dato description (MUTADOR)
        $this->attributes['description'] = ucfirst($value);
    }

    // RELACIONES
    public function measurement_unit(){ // Accede a la información de unidad de medidad
        return $this->belongsTo(MeasurementUnit::class);
    }
    public function kind_of_purchase(){ // Accede a la información de unidad del tipo de compra
        return $this->belongsTo(KindOfPurchase::class);
    }
    public function category(){ // Accede a la información de categoría
        return $this->belongsTo(Category::class);
    }

}
