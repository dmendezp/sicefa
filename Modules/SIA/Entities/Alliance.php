<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;

class Alliance extends Model
{
    protected $table = 'alliances';

    protected $fillable = [
        'name',
        'description',
        'organization',
        'email',
        'start_date',
        'end_date',
        'status',
    ];

    protected $dates = ['start_date', 'end_date'];

    /**
     * Obtiene la fecha de inicio formateada.
     */
    public function getStartDateAttribute($value)
    {
        return $this->asDateTime($value)->format('Y-m-d');
    }

    /**
     * Obtiene la fecha de fin formateada.
     */
    public function getEndDateAttribute($value)
    {
        return $value ? $this->asDateTime($value)->format('Y-m-d') : null;
    }
}