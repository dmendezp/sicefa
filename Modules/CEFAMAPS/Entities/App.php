<?php

namespace Modules\CEFAMAPS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CEFAMAPS\Entities\Role;
use Modules\CEFAMAPS\Entities\Permission;

class App extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['name','url','color','icon','description'];
    
    public function roles(){
        return $this->hasMany(Role::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }

}
