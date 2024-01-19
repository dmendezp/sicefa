<?php

namespace Modules\AGROINDUSTRIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Course;

class RequestExternal extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masivaa)
        'date',
        'coordinator',
        'receiver',
        'course_id',
        'status'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    //RELACIONES
    public function person(){
        return $this->belongsTo(Person::class, 'coordinator');
    }
    public function productive_unit(){ // Accede a la información de la unidad productiva al que pertenece
        return $this->belongsTo(ProductiveUnit::class);
    }
    public function receive(){ // Accede a la información de la persona al que pertenece
        return $this->belongsTo(Person::class, 'receiver');
    }
    public function supplies(){ // Accede a la información de los insumos que pertenecen a esta solicitud
        return $this->hasMany(Supply::class);
    }
    public function course(){ // Accede a la información del curso al que pertenece
        return $this->belongsTo(Course::class);
    }
    
}
