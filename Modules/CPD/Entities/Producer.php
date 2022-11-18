<?php

namespace Modules\CPD\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends Model
{

    use SoftDeletes;
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function studies(){
        return $this->hasMany(Study::class);
    }

}
