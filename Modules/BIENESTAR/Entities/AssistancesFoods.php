<?php

namespace Modules\BIENESTAR\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class assistances_foods extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\BIENESTAR\Database\factories\AssistancesFoodsFactory::new();
    }
}