<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Role;

class ApprenticePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id', 
        'instructor_id',
        'course_id',
        'date',
        'time_start',
        'time_finish',
        'permission_reason',
        'permission_detail',
        'evidence_url',
        'status'
    ];

    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ApprenticePermissionFactory::new();
    }

    // 🔗 Relación con el usuario que creó el permiso
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Relación con el aprendiz (si aplica en tu lógica)
    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class);
    }

    // 🔗 Relación con el rol (si estás usando roles para permisos)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function instructor()
{
    return $this->belongsTo(\Modules\SICA\Entities\Instructor::class);
}
public function person()
{
    return $this->belongsTo(\Modules\SICA\Entities\Person::class);
}
public function course()
{
    return $this->belongsTo(\Modules\SICA\Entities\Course::class);
}
public function permissionValidations()
{
    return $this->hasMany(PermissionValidation::class, 'apprentice_permission_id');
}
public function hasActiveInternship()
{
    return $this->person
        ->boardingSchools()
        ->whereDate('start_date', '<=', $this->date)
        ->whereDate('end_date', '>=', $this->date)
        ->exists();
}

}