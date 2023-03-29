<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\Municipality;

class Village extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }

    public function studies(){
        return $this->hasMany(Study::class);
    }

    public function getVillMunAttribute(){
        return $this->municipality->name.' / '.$this->name;
    }

}
