<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Municipality;
use OwenIt\Auditing\Contracts\Auditable;

class ProgramRequest extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [ // Atributos modificables (asignación masiva)
        'person_id',
        'program_id',
        'special_program_id',
        'municipality_id',
        'hours',
        'start_date',
        'end_date',
        'quotas',
        'address',
        'observation',
        'empresa',
        'applicant',
        'email',
        'telephone',
        'date_characterization',
        'code_empresa',
        'code_course',
        'date_inscription',
        'state'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = ['created_at','updated_at']; // Atributos ocultos para no representarlos en las salidas con formato JSON
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ProgramRequestFactory::new();
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    
    public function program_request_dates()
    {
        return $this->hasMany(ProgramRequestDate::class);
    }

    public function program_request_documents()
    {
        return $this->hasMany(ProgramRequestDocument::class);
    }

    public function special_program()
    {
        return $this->belongsTo(SpecialProgram::class);
    }
}
