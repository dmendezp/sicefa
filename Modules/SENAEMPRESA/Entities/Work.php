<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SENAEMPRESA\Entities\ApprenticeAsistencia;
use OwenIt\Auditing\Contracts\Auditable;

class Work extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;
    
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['name','description','productive_unit_id'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\WorkFactory::new();
    }

    public function productive_unit()
    {
        return $this->belongsTo(ProductiveUnit::class);
    }

    /* public function apprentice_attendances()
    {
        return $this->belongsToMany(ApprenticeAsistencia::class, 'apprentice_attendance_works')->withTimestamps();
    } */

    public function apprentice_attendances(){
        return $this->hasMany(ApprenticeAsistencia::class);
    }

    public function getDescriptionWorkAttribute(){
        return 'Actividad: '.$this->name.'/ Unidad: '.$this->productive_unit->name;
    }

    
}
