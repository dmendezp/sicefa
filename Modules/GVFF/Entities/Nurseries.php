<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;

class Nurseries extends Model
{
    protected $table = 'nurseries';

    protected $fillable = [
        'name',
        'location',
        'max_capacity',
        'classification',
        'description',
        'image'
    ];

    protected $casts = [
        'classification' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function plants()
    {
        return $this->hasMany(Plants::class, 'Nurseries_id');
    }
}