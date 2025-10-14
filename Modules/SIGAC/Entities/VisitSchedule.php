<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Environment;
use Modules\SIGAC\Entities\VisitRequest; // <-- añade este use si faltaba

class VisitSchedule extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $table = 'visit_schedules';

    protected $fillable = [
        'visit_request_id',
        'person_in_charge_id',
        'notification_email', // 👈 agrega esto
        'activity',
        'date',
        'start_time',
        'end_time',
        'environment_id',
        'observations',
    ];

    public function visitRequest()
    {
        return $this->belongsTo(VisitRequest::class);
    }

    public function personInCharge()
    {
        return $this->belongsTo(Person::class, 'person_in_charge_id')->withDefault();
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class)->withDefault(['name' => 'Por definir']);
    }

    // (opcional) alias para compatibilidad con código viejo
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_in_charge_id')->withDefault();
    }
}
