<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Person;

class Key extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_code',
        'environment_id',
        'position'
    ];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\KeyFactory::new();
    }

    public function environments(){ //Accede a la informacion del ambiente al que pertenece
        return $this->belongsTo(Environment::class);
    }
    public function people(){ 
        return $this->belongsToMany(Person::class, 'issued_at', 'returned_at')->withTimestamps();
    }



}
