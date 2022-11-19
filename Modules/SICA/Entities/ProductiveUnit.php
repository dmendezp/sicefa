<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Sector;

class ProductiveUnit extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['name','description','person_id','sector_id','icon'];

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

}
