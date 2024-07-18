<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class InstructorProgramNovelty extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'instructor_program_id',
        'date',
        'activity',
        'observation'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\InstructorProgramNoveltiesFactory::new();
    }

    public function instructor_program () {
        return $this->belongsTo(InstructorProgram::class);
    }
}
