<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Group;
use Modules\SIA\Entities\Project;

class ApprenticeResearcher extends Model
{
    use SoftDeletes;

    protected $table = 'apprentice_researchers';

    protected $fillable = [
        'user_id',
        'person_id',
        'eps_id',
        'program_id',
        'course_id',
        'group_id',
        'project_id',
        'institution',
        'start_date',
    ];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(EPS::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}