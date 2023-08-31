<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostulationsBenefits extends Model
{
    use HasFactory;

    protected $table = 'postulations_benefits';

    protected $fillable = [
        'benefit_id',
        'postulation_id',
        'state',
    ];

    public function benefit()
    {
        return $this->belongsTo(benefits::class, 'benefit_id');
    }

    public function postulation()
    {
        return $this->belongsTo(Postulations::class, 'postulation_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\PostulationsBenefitsFactory::new();
    }

    
}
