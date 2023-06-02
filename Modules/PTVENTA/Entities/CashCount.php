<?php

namespace Modules\PTVENTA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Person;
use OwenIt\Auditing\Contracts\Auditable;

class CashCount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD

    use HasFactory; // Generación de datos de prueba

    use SoftDeletes; // Borrado suave


    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'opening_date',
        'initial_balance',
        'final_balance',
        'difference',
        'closing_time',
        'state',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objeto Carbon (para aprovechar las funcines de formato y manipulación de fecha y hora)

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function person(){ // Accede a la persona que esta administrando el arqueo de caja
        return $this->belongsTo(Person::class);
    }
}
