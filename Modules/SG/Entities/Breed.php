<?php

namespace Modules\SG\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Breed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    // Relación con animales
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
