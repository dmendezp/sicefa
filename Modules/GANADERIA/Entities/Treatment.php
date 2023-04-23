<?php

namespace Modules\GANADERIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\GANADERIA\Entities\Disease;
use Modules\GANADERIA\Entities\Productive_proces;

class Treatment extends Model
{
    use SoftDeletes;

    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function diseases() {
        return $this->belongsTo(Disease::class);
    }

    public function productive_proces() {
        return $this->hasMany(Productive_proces::class);
    }
}
