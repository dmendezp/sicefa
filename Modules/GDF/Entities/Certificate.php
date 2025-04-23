<?php

namespace Modules\GDF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'certified_code',
        'issue_date',
        'official_id',
        'description',
    ];
    
    protected static function newFactory()
    {
        return \Modules\GDF\Database\factories\CertificateFactory::new();
    }
}
