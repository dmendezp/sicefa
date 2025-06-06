<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Inventory;

class NoveltyCheck extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['inventory_id','environment_check_id','observation'];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\NoveltyCheckFactory::new();
    }

    public function inventory(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(Inventory::class);
    }

    public function environment_check(){ // Accede a la información de los datos personales de la persona responsable
        return $this->belongsTo(EnvironmentCheck::class);
    }
}
