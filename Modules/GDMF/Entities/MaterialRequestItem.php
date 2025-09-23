<?php

namespace Modules\GDMF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Element;

class MaterialRequestItem extends Model
{
    use HasFactory;

    protected $fillable = ['material_request_id','element_id','quantity','unit_price','subtotal'];

    protected static function newFactory()
    {
        return \Modules\GDMF\Database\factories\MaterialRequestItemFactory::new();
    }

    public function element()
    {
        return $this->belongsTo(Element::class);
    }

    public function request()
    {
        return $this->belongsTo(MaterialRequest::class, 'material_request_id');
    }
}
