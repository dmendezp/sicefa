<?php

namespace Modules\SENAEMPRESA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;


class vacancy extends Model
{
    use \OwenIt\Auditing\Auditable, // Seguimientos de cambios realizados en BD
    SoftDeletes, // Borrado suave
    HasFactory; 

    protected $fillable = ['name', 'image', 'description_general', 'requirement', 'position_company_id','start_date', 'end_date'];
    
    protected static function newFactory()
    {
        return \Modules\SENAEMPRESA\Database\factories\VacancyFactory::new();
    }
}
