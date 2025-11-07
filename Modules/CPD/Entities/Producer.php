<?php

namespace Modules\CPD\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Producer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function studies(){
        return $this->hasMany(Study::class);
    }

}
