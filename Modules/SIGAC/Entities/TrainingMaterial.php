<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Element;
use OwenIt\Auditing\Contracts\Auditable;

class TrainingMaterial extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = [];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
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
