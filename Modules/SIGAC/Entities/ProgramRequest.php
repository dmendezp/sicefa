<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramRequest extends Model
{
    use HasFactory;

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'program_id',
        'special_program_id',
        'municipality_id',
        'start_date',
        'end_date',
        'quotas',
        'address',
        'observation',
        'empresa',
        'applicant',
        'email',
        'telephone',
        'date_characterization',
        'code_empresa',
        'code_course',
        'date_inscription'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = ['created_at','updated_at']; // Atributos ocultos para no representarlos en las salidas con formato JSON
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ProgramRequestFactory::new();
    }
}
