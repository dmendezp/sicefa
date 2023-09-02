<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocioEconomicSupportFiles extends Model
{
    use HasFactory;

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
