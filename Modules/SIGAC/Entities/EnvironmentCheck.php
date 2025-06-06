<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Person;

class EnvironmentCheck extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['security_id','responsability_id','environment_id','date','start_time','end_time','state'];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\EnvironmentCheckFactory::new();
    }

    public function security(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Person::class);
    }

    public function responsability(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Person::class);
    }

    public function environment(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Environment::class);
    }
    
    
}
