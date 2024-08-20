<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;
use OwenIt\Auditing\Contracts\Auditable;

class InstitucionalRequest extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = [
        'person_id',
        'reason',
        'date',
        'start_time',
        'end_time'
    ];

    protected $dates = ['deleted_at']; // Atributos que deben ser tratados como objetos Carbon

    protected $hidden = [ // Atributos ocultos para no representarlos en las salidas con formato JSON
        'created_at',
        'updated_at'
    ];
    
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\InstitucionalRequestFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
