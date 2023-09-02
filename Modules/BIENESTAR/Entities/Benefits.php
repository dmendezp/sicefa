<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Benefits extends Model
{
    use HasFactory;

    protected $table = 'benefits';

    protected $fillable = ['name', 'porcentege'];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\BenefitsFactory::new();
    }

    public function postulationBenefits(){// Accede a los datos del beneficio que tiene la postulacion al que pertenece
        return $this->hasMany(PostulationsBenefits::class, 'benefit_id');
    }
}
