<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Convocations extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','update_at'];

    protected $fillable = [
        'id', 
        'title', 	
        'description',
        'start_date',
        'end_date',
        'transport_quotas',
        'food_quotas',
    ];
    
    public function ConvocationsQuestions(){
        return $this->hasMany(ConvocationQuestion::class);
    }
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\ConvocationsFactory::new();
    }
}
