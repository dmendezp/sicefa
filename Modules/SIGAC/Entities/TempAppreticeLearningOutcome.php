<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TempAppreticeLearningOutcome extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'tipo',
        'documento',
        'nombre',
        'apellidos',
        'estado',
        'competencia',
        'resultado',
        'juicio'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

}
