<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\Course;

class Program extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'sofia_code',
        'version',
        'training_type',
        'name',
        'qurter_number',
        'knowledge_network_id',
        'program_type',
        'maximum_duration',
        'modality',
        'fic',
        'months_lectiva',
        'months_productiva'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // MUTADORES Y ACCESORES
    public function setNameAttribute($value){ // Convierte todos los carácteres en mayúsculas del dato name (MUTADOR)
        $this->attributes['name'] = mb_strtoupper($value);
    }

    // RELACIONES
    public function courses(){ // Accede a todos los cursos asociados a este programa de formación
        return $this->hasMany(Course::class);
    }
    public function knowledge_network(){ // Accede a la red de conocimiento al que pertenece
        return $this->belongsTo(KnowledgeNetwork::class);
    }

    public function competencies(){ //Accede a todas las competencias asociadas a este programa.
        return $this->hasMany(Competencie::class);
    }


    // Configuración de factory para la generación de datos de pruebas
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\ProgramFactory::new();
    }

}
