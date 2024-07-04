<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramRequestDate extends Model
{
    use HasFactory;

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'program_request_id',
        'date',
        'start_time',
        'end_time'
    ];
    
    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = ['created_at','updated_at']; // Atributos ocultos para no representarlos en las salidas con formato JSON

    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ProgramRequestDateFactory::new();
    }
}
