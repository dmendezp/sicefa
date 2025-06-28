<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\SIA\Entities\Group;
use Modules\SIA\Entities\Project;
use Modules\SICA\Entities\Role;

class ApprenticeResearcher extends Model
{
    use SoftDeletes;

    protected $table = 'apprentice_researchers';

    protected $fillable = [
        'user_id', 'person_id', 'program_id', 'course_id', 'group_id', 'project_id', 'institution', 'default_role_id',
    ];

    protected $dates = ['deleted_at'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
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

    public function defaultRole()
    {
        return $this->belongsTo(Role::class, 'default_role_id');
    }
}