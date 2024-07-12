<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Person;

class EnvironmentWarehouse extends Model implements Auditable
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
        return \Modules\SIGAC\Database\factories\EnvironmentWarehouseFactory::new();
    }

    public function warehouse(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Warehouse::class);
    }

    public function environment(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Environment::class);
    }

    public function person(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Person::class);
    }
}
