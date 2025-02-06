<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use App\Models\User;

class Role extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes; // Borrado suave

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'name',
        'slug',
        'description',
        'description_english',
        'full_access',
        'app_id'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function app(){ // Accede a la aplicación al que pertenece
        return $this->belongsTo(App::class);
    }
    public function permissions(){ // Accede a todos los permisos que pertenecen a este rol (PIVOTE)
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
    public function productive_units(){ // Accede a todos las unidades productivas que pertenecen a este rol (PIVOTE)
        return $this->belongsToMany(ProductiveUnit::class)->withTimestamps();
    }
    public function responsibilities(){ // Accede a todas los registros de responsabilidades que pertenecen a este rol
        return $this->hasMany(Responsibility::class);
    }
    public function users(){ // Accede todos los usuarios que pertenecen a este rol (PIVOTE)
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
