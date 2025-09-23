<?php

namespace Modules\GDMF\Entities;

use Modules\SICA\Entities\Element;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id', 'material_request_id', 'element_id', 'quantity', 'unit_price', 'subtotal', 'financed_by'];

    protected static function newFactory()
    {
        return \Modules\GDMF\Database\factories\PurchaseDetailFactory::new();
    }

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
    public function material_request()
    {
        return $this->belongsTo(MaterialRequest::class);
    }
}
