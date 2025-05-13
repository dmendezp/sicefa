<?php

namespace Modules\PSERENACEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class course extends Model
{
    use HasFactory;

    protected $fillable = ['code'];
    
    protected static function newFactory()
    {
        return \Modules\PSERENACEFA\Database\factories\CourseFactory::new();
    }
}
