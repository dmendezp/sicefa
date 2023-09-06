<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SocioEconomicSupportFiles extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable,
    SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];

    protected $table = 'socio_economic_support_files';

    protected $fillable = [
        'file_path',
        'postulation_id',
    ];

    public function postulation()
    {
        return $this->belongsTo(Postulations::class, 'postulation_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\SocioEconomicSupportFilesFactory::new();
    }

    
}
