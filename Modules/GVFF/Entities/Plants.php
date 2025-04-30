<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;

class Plants extends Model
{
    protected $table = 'plants';

    protected $fillable = [
        'nurseries_id',
        'scientific_name',
        'common_name',
        'plant_type',
        'structure_type',
        'family',
        'characteristics',
        'benefits',
        'properties',
        'traditional_uses',
        'status',
        'inventory',
        'price',
        'location',
        'image',
        'available',
        'observations'
    ];

    protected $casts = [
        'plant_type' => 'string',
        'structure_type' => 'string',
        'status' => 'string',
        'available' => 'boolean',
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function nurseries()
    {
        return $this->belongsTo(nurseries::class, 'nurseries_id');
    }
}