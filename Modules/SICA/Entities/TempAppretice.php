<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TempAppretice extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    protected $table = 'temp_appretices'; // Definir tabla para el modelo

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'tipo',
        'documento',
        'nombre',
        'apellidos',
        'celular',
        'correo',
        'estado',
        'programa',
        'ficha'
    ];

    protected $hidden = [ // Datos para ocultar en una respuesta array o JSON
        'created_at',
        'updated_at'
    ];

}
