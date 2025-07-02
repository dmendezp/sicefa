<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Obtiene la fecha de creación formateada.
     */
    public function getCreatedAtAttribute($value)
    {
        return $this->asDateTime($value)->format('Y-m-d H:i');
    }
}