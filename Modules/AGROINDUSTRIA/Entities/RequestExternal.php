<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Person;

class RequestExternal extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asginación masivaa)
        'date',
        'productive_unit_id',
        'coordinator',
        'receiver',
        'region_code',
        'region_name',
        'cost_code',
        'cost_center_name'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    //RELACIONES
    public function person(){ // Accede a la información de la unidad productiva al que pertenece
        return $this->belongsTo(Person::class);
    }
    public function productive_unit(){ // Accede a la información de la unidad productiva al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }
    public function supplies(){ // Accede a la información de los insumos que pertenecen a esta solicitud
        return $this->hasMany(Supply::class);
    }
    
}
