<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'state', 'pdf_report_path', 'person_id'];
    
    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\ResearchProjectFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function research_project_applications()
    {
        return $this->hasMany(ResearchProjectApplication::class);
    }
    
}
