<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    protected $table = 'project_role';

    protected $fillable = [
        'project_id',
        'role_user_id',
    ];

    // Relación con el proyecto
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Relación con RoleUser
    public function roleUser()
    {
        return $this->belongsTo(\App\Models\RoleUser::class, 'role_user_id');
    }
}