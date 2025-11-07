<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Event;

class EventAttendance extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados en BD

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'event_id',
        'person_id',
        'date'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function person(){ // Accede a la información de la persona que asiste al evento
        return $this->belongsTo(Person::class);
    }
    public function event(){ // Accede a la información del evento al que pertenece
        return $this->belongsTo(Event::class);
    }

}
