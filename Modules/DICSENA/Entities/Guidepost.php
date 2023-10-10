<?php

namespace Modules\DICSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;

class Guidepost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'program_id'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
