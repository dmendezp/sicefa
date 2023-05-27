<?php

namespace Modules\PTVENTA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arqueo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'saldo_inicial',
        'saldo_final',
        'diferencia',
    ];
}
