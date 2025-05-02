<?php

namespace Modules\Toolhub\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;
    protected $table = 'tools1'; 

    protected $fillable =[
        'code',
        'name',
        'description',
        'condition',
        'is_available',
        'category',
    ];
    
    
    protected static function newFactory()
    {
        return \Modules\Toolhub\Database\factories\ToolFactory::new();
    }
}