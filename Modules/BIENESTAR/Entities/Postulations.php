<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postulations extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'postulations';

    protected $fillable = [
        'apprentice_id',
        'convocation_id',
        'type_of_benefit_id',
        'total_score',
    ];

    

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\PostulationsFactory::new();
    }

     //RELACIONES

     public function answers(){// Accede a los datos de la respuesta al que pertenece
        return $this->hasMany(Answers::class, 'postulation_id');
    }

     public function apprentice(){// Accede a los datos del aprendiz al que pertenece
        return $this->belongsTo(\Modules\SICA\Entities\Apprentice::class, 'apprentice_id');
    }

    public function convocation(){// Accede a los datos de la Convocatoria al que pertenece
        return $this->belongsTo(Convocations::class, 'convocation_id');
    }

    public function postulationBenefits(){// Accede a los datos del beneficio que tiene la postulacion al que pertenece
        return $this->hasMany(PostulationsBenefits::class, 'postulation_id');
    }

    public function typeOfBenefit(){// Accede a los datos del tipo de beneficiario al que pertenece
        return $this->belongsTo(TypesOfBenefits::class, 'type_of_benefit_id');
    }
    

    
}
