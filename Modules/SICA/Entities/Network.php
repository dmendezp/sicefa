<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Line;

class Network extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'line_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon 

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // convierte todos los carácteres en mayúsculas del dato name (MUTADOR)
        $this->attributes['name'] = mb_strtoupper($value);
    }

    // RELACIONES
    public function line(){ // Accede a la línea tecnologica al que pertenece
        return $this->belongsTo(Line::class);
    }
    public function programs(){ // Accede a todos los programas asociados a esta red de conocimiento
        return $this->hasMany(Program::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\NetworkFactory::new();
    }

}
