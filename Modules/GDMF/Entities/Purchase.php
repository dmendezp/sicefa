<?php

namespace Modules\GDMF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_date', 'total_amount', 'observation'];

    protected static function newFactory()
    {
        return \Modules\GDMF\Database\factories\PurchaseFactory::new();
    }

    public function purchase_details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
