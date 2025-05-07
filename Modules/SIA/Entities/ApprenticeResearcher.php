<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class ApprenticeResearcher extends Model
{
    protected $table = 'apprentice_researchers';
    protected $fillable = ['user_id', 'person_id', 'program_type', 'program_id', 'ficha', 'stage', 'project_id'];
    protected $casts = [
        'program_type' => 'string',
        'stage' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}