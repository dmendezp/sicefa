<?php

namespace Modules\PQRS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;

class Pqrs extends Model
{
    use HasFactory;

    protected $fillable = [ // Atributos modificables (asginación masiva)
        'type_pqrs_id',
        'filing_number',
        'filing_date',
        'nis',
        'star_date',
        'end_date',
        'issue',
        'state',
        'answer',
        'filed_response',
        'response_date',
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
    // RELACIONES
    public function people(){ // Accede todos las personas que pertenecen a esta pqrs (PIVOTE)
        return $this->belongsToMany(Person::class)->withPivot('date_time', 'type')->withTimestamps();
    }
    public function type_pqrs(){ // Accede a la información del tipo de pqrs al que pertenece
        return $this->belongsTo(TypePqrs::class);
    }
}
