<?php

namespace Modules\GDMF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnualBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'budget_total',
        'budget_current'
    ];
    
    protected static function newFactory()
    {
        return \Modules\GDMF\Database\factories\AnnualBudgetFactory::new();
    }
}
