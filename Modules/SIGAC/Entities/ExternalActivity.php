<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class ExternalActivity extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use HasFactory;

    protected $fillable = ['name','description'];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ExternalActivityFactory::new();
    }
}
