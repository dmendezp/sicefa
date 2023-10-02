<?php

namespace Modules\DICSENA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Person;



class Glossary extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'traduction',
        'meaning',
        'program_id'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
