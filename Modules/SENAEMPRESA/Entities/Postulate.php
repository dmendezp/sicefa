<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Apprentice;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class postulate extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
        SoftDeletes, // Borrado suave
        HasFactory;

    protected $fillable = ['apprentice_id', 'vacancy_id', 'state', 'cv', 'personalities', 'proposal', 'employment_certificate', 'score_total'];

    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\PostulateFactory::new();
    }
    public function Apprentice()
    { // Accede a la información del aprendiz
        return $this->belongsTo(Apprentice::class);
    }
    public function vacancy()
    { //Accede a los vacantes disponibles
        return $this->belongsTo(Vacancy::class);
    }

    public function file_senaempresa()
    {
        return $this->hasOne(FileSenaempresa::class);
    }
}
