<?php

namespace Modules\SIPORK\Entities;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;





class Pig extends Model
{
    use HasFactory;
    protected $table = 'pigs'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_pig'; //
    public $timestamps = true; // Habilitar timestamps (created_at, updated_at)


    protected $fillable = ['birth_date', 'initial_weight', 'gender', 'breed', 'status', 'weaning_date', 'sale_date', 'gender_check'];

    public function reproductiveCycles()
    {
        return $this->hasMany(ReproductiveCycle::class, 'sow_id', 'id_pig');
    }

    public function growthTracking()
    {
        return $this->hasMany(GrowthTracking::class, 'pig_id', 'id_pig');
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'pig_id', 'id_pig');
    }

    public function lots()
    {
        return $this->belongsToMany(Lot::class, 'pigs_lots', 'pig_id', 'lot_id')
                    ->withPivot('entry_date', 'exit_date');
    }

    public function feeding()
    {
        return $this->hasMany(Feeding::class, 'pig_id', 'id_pig');
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'tools_pigs', 'pig_id', 'tool_id')
                    ->withPivot('usage_date', 'task_description');
    }
    
}
