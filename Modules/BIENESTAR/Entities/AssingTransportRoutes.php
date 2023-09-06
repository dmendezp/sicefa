<?php

namespace Modules\BIENESTAR\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class assing_transport_routes extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AssingTransportRoutesFactory::new();
    }
}
