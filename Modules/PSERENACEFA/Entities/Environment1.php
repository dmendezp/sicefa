<?php

namespace Modules\PSERENACEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Environment1 extends Model
{
    use HasFactory;

    protected $table = 'environments1';

    protected $fillable =  ['name', 'capacity', 'location', 'description', 'status'];
    
    protected static function newFactory()
    {
        return \Modules\PSERENACEFA\Database\factories\Environment1Factory::new();
    }
}
