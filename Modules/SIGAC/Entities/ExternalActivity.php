<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExternalActivity extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\ExternalActivityFactory::new();
    }
}
