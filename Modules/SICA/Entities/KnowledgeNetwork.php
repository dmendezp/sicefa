<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class KnowledgeNetwork extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    HasFactory; // Generación de datos de prueba

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'network_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];


    // RELACIONES
    public function network(){ // Accede a todos los cursos asociados a este programa de formación
        return $this->belongsTo(Network::class);
    }
    public function programs(){ // Accede a todos los cursos asociados a este programa de formación
        return $this->hasMany(Program::class);
    }
    
    
    protected static function newFactory()
    {
        return \Modules\SICA\Database\factories\KnowledgeNetworkFactory::new();
    }
}
