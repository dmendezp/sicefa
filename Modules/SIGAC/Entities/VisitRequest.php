<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitRequest extends Model
{
    use HasFactory;

    protected $table = 'visit_requests';

    protected $fillable = [
        'company_id',
        'person_id',
        'user_id',
        'date_received',
        'response_date',
        'response_method',
        'state',
        'number_of_people',
        'people_list_path',
        'observations',

        // NUEVOS
        'contact_name',
        'contact_phone',
        'contact_email',
        'type',                   // 'visita' | 'practica'
        'practice_requirements',  // nullable
    ];

    protected $casts = [
        'date_received' => 'date',
        'response_date' => 'date',
        'number_of_people' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* Relaciones */
    public function company()
    {
        return $this->belongsTo(\Modules\SIGAC\Entities\Company::class, 'company_id');
    }

    public function person()
    {
        // Relacionado con módulo SICA
        return $this->belongsTo(\Modules\SICA\Entities\Person::class, 'person_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(\Modules\SIGAC\Entities\VisitSchedule::class, 'visit_request_id');
    }

    /* Scopes útiles (opcionales) */
    public function scopeType($q, string $type)
    {
        return $q->where('type', $type);
    }

    public function scopePending($q)
    {
        return $q->where('state', 'Sin agendar');
    }
}
