<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Convocations extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
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
    //RELACIONES

    public function questions(){// Accede a los datos de la Pregunta al que pertenece
        return $this->belongsToMany(Questions::class, 'convocations_questions');
    }
 

}
