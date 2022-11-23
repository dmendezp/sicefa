<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TempAppretice extends Model
{
    protected $fillable = [
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
    protected $table = 'temp_appretices';
}
