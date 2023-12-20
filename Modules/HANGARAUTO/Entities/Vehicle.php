<?php
 
namespace Modules\HANGARAUTO\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
 
use Illuminate\Database\Eloquent\Model;
 
class Vehicle extends Model
{
    use SoftDeletes;
    protected $table = 'Vehicles';
    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at','updated_at'];

    public function Reference(){
        return $this->belongsTo('Modules\HANGARAUTO\Entities\Reference');
    }

    public function Soat(){
        return $this->hasMany('Modules\HANGARAUTO\Entities\Soat');
    }

    public function Tecnomecanic(){
        return $this->hasMany('Modules\HANGARAUTO\Entities\Tecnomecanic');
    }
}