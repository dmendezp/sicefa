<?php

namespace Modules\EVS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Elected extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable; // Seguimientos de cambios realizados BD
    use SoftDeletes;
    protected $fillable = ['candidate_id','election_id','status','votes','job','email','telephone'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','update_at'];


    public function candidate(){
    	return $this->belongsTo(Candidate::class);
    }

    public function election(){
        return $this->belongsTo(Election::class);
    }

}
