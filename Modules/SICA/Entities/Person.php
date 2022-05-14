<?php

namespace Modules\SICA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\Apprentice;
use Modules\EVS\Entities\Candidate;
use Modules\EVS\Entities\Jury;
use Modules\EVS\Entities\Authorized;
use App\Models\User;

class Person extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = [
        'document_type',
        'document',
        'date_of_issue',
        'first_name',
        'first_last_name',
        'second_last_name',
        'birthday',
        'blood_type',
        'gender',
        'eps_id',
        'marital_status',
        'military_card',
        'socioeconomic_status',
        'address',
        'telephone1',
        'telephone2',
        'telephone3',
        'personal_email',
        'misena_email',
        'sena_email',
        'avatar',
        'population_group_id'
    ];

    public function e_p_s(){
        return $this->belongsTo(EPS::class);
    }

    public function population_group(){
        return $this->belongsTo(PopulationGroup::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function apprentices(){
        return $this->hasMany(Apprentice::class);
    }

    public function authorizeds(){
        return $this->hasMany(Authorized::class);
    }

    public function juries(){
        return $this->hasMany(Jury::class);
    }

}
