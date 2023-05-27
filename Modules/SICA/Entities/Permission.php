<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class Permission extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['name','slug','description','full-access','app_id'];

    public function app(){
        return $this->belongsTo(App::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

}
