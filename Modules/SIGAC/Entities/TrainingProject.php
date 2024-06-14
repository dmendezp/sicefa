<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Course;
use OwenIt\Auditing\Contracts\Auditable;                                                                                   

class TrainingProject extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['name', 'code', 'execution_time', 'objective'];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\TrainingProjectFactory::new();
    }

    public function courses(){ //Accede a todos los cursos que pertenecen a este projecto formativo.
        return $this->belongsToMany(Course::class, 'course_training_projects');
    }

    public function quarterlies(){ //Accede a todas las trimestralizaciones del proyecto formativo.
        return $this->hasMany(Quarterly::class);
    }

    public function training_materials(){ //Accede a todos los registros de proyecto formativo y elemento que pertenece a este elemento.
        return $this->hasMany(TrainingMaterial::class);
    }
    
}
