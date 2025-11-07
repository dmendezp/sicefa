<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use OwenIt\Auditing\Contracts\Auditable;

class AttendanceApprentice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['date','state','person_id','instructor_program_id'];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\AttendanceApprendiceFactory::new();
    }

    public function person(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Person::class);
    }

    public function instructor_program(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(InstructorProgram::class);
    }
}
