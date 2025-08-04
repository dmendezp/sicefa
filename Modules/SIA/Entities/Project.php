<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'estado',
        'pdf_report_path',
        'leader_id',
    ];

    protected $dates = ['start_date', 'end_date', 'deleted_at'];

    /**
     * Relación con el líder del proyecto.
     */
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    /**
     * Relación muchos-a-muchos con usuarios a través de project_role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_role')->withTimestamps();
    }

    /**
     * Verifica si el proyecto está en curso.
     */
    public function isInProgress()
    {
        return $this->estado === 'EN_CURSO';
    }
}