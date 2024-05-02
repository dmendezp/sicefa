<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'quantity',
        'theme',
        'state',
        'apprentice_id',
        'course_id'  // Changed from 'program_id'
    ];

    public function apprentice()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Apprentice::class, 'apprentice_id', 'id');
    }

    public function course()  // Changed from 'program'
    {
        return $this->belongsTo(\Modules\SICA\Entities\Course::class, 'course_id', 'id');  // Assuming the model is Course
    }

    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\PointFactory::new();
    }
}
