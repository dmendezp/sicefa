<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Apprentice;
use Modules\AGROINDUSTRIA\Entities\RequestExternal;


class Course extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [// Atributos modificables (asignación masiva)
        'code',
        'star_date',
        'end_date',
        'status',
        'program_id',
        'deschooling'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function getCodeNameAttribute(){ // Obtiene el código y el nombre del programa de formación de manera concatenada
        return "{$this->code} {$this->program->name}";
    }

    // RELACIONES
    public function apprentices(){ // Accede a todos los aprendices de este curso formativo
        return $this->hasMany(Apprentice::class);
    }
    public function program(){ // Accede al programa de formación al que pertenece
        return $this->belongsTo(Program::class);
    }
    public function requestexternals(){ // Accede a la información de los elementos usados en la Formula.
        return $this->hasMany(RequestExternal::class);
    }

    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\CourseFactory::new();
    }

}
