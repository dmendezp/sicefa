<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\ProductiveUnit;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = [
                            'identificacion',
                            'productive_units_id',
                            'type_activities_id',
                            'period_id',
                            'date',
                            'value',
                            'observation',
                            'prioridad',
                            'status',
                        
                        ];
    
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\ActivityFactory::new();
    }

    
}
