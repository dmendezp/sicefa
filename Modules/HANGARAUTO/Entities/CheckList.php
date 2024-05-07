<?php

namespace Modules\HANGARAUTO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckList extends Model
{
    use HasFactory;
    protected $fillable = [
        'check_id', 
        'inspection',
        'observation',
        'complete',
    ];
    protected $table = 'check_lists';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at'];

    public function check(){
        return $this->belongsTo(Check::class);
    }
}
