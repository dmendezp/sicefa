<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use \OwenIt\Auditing\Auditable;

class attendance extends Model
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes, // Borrado suave
    HasFactory; 

    protected $fillable = ['staff_senaempresa_id', 'start_date', 'end_date'];

    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\AttendanceFactory::new();
    }
}
