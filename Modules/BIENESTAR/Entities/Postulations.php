<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Postulations extends Model
{
    use HasFactory;

    protected $table = 'postulations';

    protected $fillable = [
        'apprentice_id',
        'convocation_id',
        'type_of_benefit_id',
        'total_score',
    ];

    public function apprentice()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Apprentice::class, 'apprentice_id');
    }

    public function convocation()
    {
        return $this->belongsTo(Convocations::class, 'convocation_id');
    }

    public function typesOfBenefits()
    {
        return $this->belongsTo(TypesOfBenefits::class, 'type_of_benefit_id');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class, 'postulation_id');
    }

    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\PostulationsFactory::new();
    }

     
}
