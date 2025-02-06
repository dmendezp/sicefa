<?php

namespace Modules\CPD\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Village;
use OwenIt\Auditing\Contracts\Auditable;

class Study extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use SoftDeletes;
    protected $fillable = [
        'producer_id','monitoring','village_id','typology',
        'pH', 'Ar', 'Arc', 'Lim', 'CE', 'COT', 'MO', 'N', 'P', 'Na',
        'K', 'Ca', 'Mg', 'Mn', 'Fe', 'Zn', 'Cu', 'CIC', 'B',
        'S', 'Cd', 'Het', 'Hon', 'Bac', 'For', 'Lum', 'Isop', 'Cole',
        'Car', 'IPyE', 'IE', 'IP', 'PPC', 'PC', 'Pre', 'Tem', 'Rad',
        'DPV', 'ET0', 'ETc', 'EPE', 'SHP', 'UC', 'CFT', 'EPL'
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function producer(){
        return $this->belongsTo(Producer::class);
    }

    public function village(){
        return $this->belongsTo(Village::class);
    }

}
