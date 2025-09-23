<?php

namespace Modules\GDMF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnualBudgetTrainingProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'annual_budget_id',
        'training_project_id',
        'budget_total',
        'budget_current'
    ];
    
    protected static function newFactory()
    {
        return \Modules\GDMF\Database\factories\AnnualBudgetTrainingProjectsFactory::new();
    }

    public function annual_budget()
    {
        return $this->belongsTo(AnnualBudget::class);
    }
}
