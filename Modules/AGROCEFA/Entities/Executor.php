<?php

namespace Modules\AGROCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AGROCEFA\Entities\EmployementType;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Person;

class Executor extends Model
{
    use HasFactory;

    protected $fillable = [
        'labor_id',
        'person_id',
        'employement_type_id',
        'amount',
        'price'
    ];

    public function employementType(){
        return $this->belongsTo(EmployementType::class,);
    }
    public function labor(){
        return $this->belongsTo(Labor::class,);
    }

    public function person(){
        return $this->belongsTo(Person::class,); // Cambio a 'person_id'
    }


}



