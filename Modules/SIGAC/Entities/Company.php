<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo Company
 *
 * Representa una empresa o institución a la que se le puede realizar una visita.
 */
class Company extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'nit',
        'contact_name',
        'contact_phone',
        'contact_email',
        'address',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Relación con las solicitudes de visita.
     */
    public function visitRequests()
    {
        return $this->hasMany(VisitRequest::class);
    }
}
