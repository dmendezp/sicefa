<?php

namespace Modules\RADIOCEFA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class voting_theme extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\RADIOCEFA\Database\factories\VotingThemeFactory::new();
    }
}
