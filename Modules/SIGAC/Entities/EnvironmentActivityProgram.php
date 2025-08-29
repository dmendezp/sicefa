<?php

namespace Modules\SIGAC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnvironmentActivityProgram extends Model
{
    use HasFactory;

    protected $fillable = ['environment_id','activity_name','activity_description','date','start_time','end_time','person_id'];
    
    /**
     * Relación con el ambiente
     */
    public function environment()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Environment::class);
    }
    
    /**
     * Relación con la persona
     */
    public function person()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Person::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\SIGAC\Database\factories\EnvironmentActivityProgramFactory::new();
    }
}
