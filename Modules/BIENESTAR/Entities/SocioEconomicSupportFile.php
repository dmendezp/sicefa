<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SocioEconomicSupportFile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'socio_economic_support_files';

    protected $fillable = [
        'file_path',
        'postulation_id',
    ];

    
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\SocioEconomicSupportFilesFactory::new();
    }

    //RELACIONES

    public function postulation(){// Accede a todas las postulaciones que pertenecen 
        return $this->belongsTo(Postulation::class, 'postulation_id');
    }

    
}
