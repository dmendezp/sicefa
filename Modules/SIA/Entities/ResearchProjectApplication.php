<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Apprentice;

class ResearchProjectApplication extends Model
{
    use HasFactory;

    protected $fillable = ['research_project_id', 'apprentice_id', 'status', 'observation'];
    
    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\ResearchProjectApplicationFactory::new();
    }

    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class, 'apprentice_id');
    }
}
