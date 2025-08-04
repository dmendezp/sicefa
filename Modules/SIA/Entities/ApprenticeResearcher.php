<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\SIA\Entities\Group;
use Modules\SIA\Entities\Project;

class ApprenticeResearcher extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'apprentice_researchers';

    protected $fillable = [
        'person_id',
        'user_id',
        'program_id',
        'course_id',
        'group_id',
        'project_id',
        'institution'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // RELACIONES
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // MÉTODOS PERSONALIZADOS
    public function getFullInfoAttribute()
    {
        return sprintf(
            '%s - %s (%s) - Programa: %s, Curso: %s',
            $this->person->fullName,
            $this->user->nickname,
            $this->institution,
            $this->program->name,
            $this->course->codeName
        );
    }

    /**
     * Edita los datos del aprendiz investigador.
     * @param array $data
     * @return bool
     */
    public function edit(array $data): bool
    {
        $validatedData = array_filter($data, function ($value) {
            return $value !== null && $value !== '';
        });

        return $this->update($validatedData);
    }

    /**
     * Elimina el aprendiz, su usuario y su persona.
     * @return bool
     */
    public function remove()
    {
        try {
            $this->user->delete();
            $this->person->delete();
            $this->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\ApprenticeResearcherFactory::new();
    }
}