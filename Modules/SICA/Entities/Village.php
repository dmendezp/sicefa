<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Municipality;

class Village extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    use SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'municipality_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Datos para ocultar en una respuesta array o JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function getVillMunAttribute(){ // Obtener el nombre del municipio junto con el nombre de la vereda (ACCESOR)
        return $this->municipality->name.' / '.$this->name;
    }
    public function setNameAttribute($value){ // Convierte el primer carácter en mayúscula del dato name (MUTADOR)
        $this->attributes['name'] = ucfirst($value);
    }

    // RELACIONES
    public function municipality(){ // Accede a la información del municipio al que pertenece
        return $this->belongsTo(Municipality::class);
    }
    public function studies(){
        return $this->hasMany(Study::class);
    }

}
