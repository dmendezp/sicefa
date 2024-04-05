<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ProfessionFactory::new();
    }

    public function people(){   //Accede a todas las personas que tienen esta profesion.
        return $this->belongsToMany(Person::class);
    }

    public function programs(){   //Accede a todos los programas que tienen esta profesion.
        return $this->belongsToMany(Person::class);
    }
}
