<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Person;

use App\Models\Traits\UserTrait;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, Notifiable, UserTrait;

    protected $fillable = ['nickname','person_id','email','password'];
    protected $hidden = ['password','remember_token','created_at','updated_at'];
    protected $casts = ['email_verified_at' => 'datetime'];
    protected $dates = ['deleted_at'];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /* relation model to finger print */
    /* public function fingerprints() {
        return $this->hasMany("App\Models\DpfpModels\FingerPrint");
    } */

}
