<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'leader_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Relación con el líder del proyecto (usuario).
     */
    public function leader()
    {
        return $this->belongsTo(\App\Models\User::class, 'leader_id');
    }

    /**
     * Relación muchos a muchos con RoleUser a través de la tabla pivote project_role.
     */
    public function roleUsers()
    {
        return $this->belongsToMany(
            \App\Models\RoleUser::class,
            'project_role',
            'project_id',
            'role_user_id'
        )->withTimestamps();
    }

    /**
     * Relación uno a muchos con el modelo pivote ProjectRole.
     */
    public function projectRoles()
    {
        return $this->hasMany(ProjectRole::class, 'project_id');
    }

    /**
     * Scope para filtrar proyectos activos (los que no han terminado).
     */
    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', now());
        });
    }

    /**
     * Fábrica del modelo.
     */
    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\ProjectFactory::new();
    }
}