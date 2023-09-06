<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class TypesOfBenefits extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

   
    protected $fillable = [
        'name',
    ];

    // Define el nombre de la tabla en la base de datos
    protected $table = 'types_of_benefits';
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\TypesOfBenefitsFactory::new();
    }

    public function postulation(){// Accede a los datos de la postulacion al que pertenece
        return $this->belongsTo(Postulations::class, 'postulation_id');
    }
}
