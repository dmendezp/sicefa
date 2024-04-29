<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Competencie;
use OwenIt\Auditing\Contracts\Auditable;

class Profession extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
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
        return $this->belongsToMany(Person::class, 'person_professions');
    }

    public function competencies(){   //Accede a todas las competencias que tienen esta profesion.
        return $this->belongsToMany(Competencie::class, 'competencie_professions');
    }
    

}
