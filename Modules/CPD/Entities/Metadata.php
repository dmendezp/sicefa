<?php

namespace Modules\CPD\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metadata extends Model
{

    use SoftDeletes;
    protected $fillable = ['data_id','abbreviation','description','unit_measure'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function data(){
        return $this->belongsTo(Data::class);
    }

}
