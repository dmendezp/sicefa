<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Element;

class TrainingMaterial extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\TrainingMaterialFactory::new();
    }

    public function element(){ //Accede al elemento al que pertenece.
        return $this->belongsTo(Element::class);
    }

    public function training_project(){ //Accede al proyecto forrmativo al que pertenece.
        return $this->belongsTo(TrainingProject::class);
    }
}
