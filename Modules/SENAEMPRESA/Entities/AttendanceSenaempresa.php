<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AttendanceSenaempresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory;
    protected $fillable = ['staff_senaempresa_id', 'start_datetime', 'end_datetime'];

    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\AttendanceSenaempresaFactory::new();
    }
    public function staffSenaempresa()
    {
        return $this->belongsTo(StaffSenaempresa::class);
    }
}
