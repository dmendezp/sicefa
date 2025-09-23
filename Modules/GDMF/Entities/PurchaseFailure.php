<?php

namespace Modules\GDMF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseFailure extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'file_hash',
        'instructor_name',
        'product_name',
        'unspsc_code',
        'reason',
    ];

    protected static function newFactory()
    {
        return \Modules\GDMF\Database\factories\PurchaseFailureFactory::new();
    }
}
