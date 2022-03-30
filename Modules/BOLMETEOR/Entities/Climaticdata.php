<?php

namespace Modules\BOLMETEOR\Entities;

use Illuminate\Database\Eloquent\Model;

class Climaticdata extends Model
{
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
