<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Apprentice;
use Modules\senaempresa\Entities\vacancy;
use Modules\senaempresa\Entities\senaempresa;

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

    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\CourseFactory::new();
    }

    public function vacancy()
    { //Accede a los vacantes disponibles
        return $this->belongsToMany(Vacancy::class);
    }

    public function senaempresa()
    { //Accede a senaempresa registrados
        return $this->belongsToMany(senaempresa::class);
    }

}
