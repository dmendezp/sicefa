<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostulationsBenefits extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'postulations_benefits';

    protected $fillable = [
        'benefit_id',
        'postulation_id',
        'state',
        'message',
    ];

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\PostulationsBenefitsFactory::new();
    }

    public function benefit(){// Accede a los datos del beneficio al que pertenece
        return $this->belongsTo(Benefits::class, 'benefit_id');
    }
    
    public function postulation(){// Accede a los datos de la postulacion al que pertenece
        return $this->belongsTo(Postulations::class, 'postulation_id');
    }

    

    
}
