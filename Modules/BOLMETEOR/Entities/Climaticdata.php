<?php

namespace Modules\BOLMETEOR\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Climaticdata extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD

    protected $fillable = [
        'person_id',
        'date_time',
        'temperature',
        'precipitation',
        'relative_humidity',
        'solar_radiation',
        'winds_direction',
        'winds_peed'
    ];
    protected $table = 'climaticdata';

    public function variable(){
    	return $this->belongsTo(Variable::class);
    }
}
