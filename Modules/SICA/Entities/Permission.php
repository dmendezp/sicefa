<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class Permission extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['name','slug','description','description_english','full-access','app_id'];

    public function app(){
        return $this->belongsTo(App::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

}
