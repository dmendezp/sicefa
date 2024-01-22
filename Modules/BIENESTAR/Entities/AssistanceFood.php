<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\BIENESTAR\Entities\PostulationsBenefits;

class AssistanceFood extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at','update_at'];

    protected $table = 'assistances_foods';
    
    protected $fillable = [
        'apprentice_id',
        'postulation_benefit_id',
        'porcentage',
        'date_time',
    ];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AssistancesFoodsFactory::new();
    }

    //RELACIONES

    public function apprentice(){// Accede a los datos del aprendiz al que pertenece
        return $this->belongsTo(\Modules\SICA\Entities\Apprentice::class, 'apprentice_id');
    }

    public function postulationBenefit(){// Accede a los datos del beneficio que tiene la postulacion al que pertenece
        return $this->belongsTo(PostulationBenefit::class, 'postulation_benefit_id');
    }


}
