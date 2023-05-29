<?php

namespace Modules\PTVENTA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CashCount extends Model
{
    use HasFactory;

    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'date',
        'initial_balance',
        'final_balance',
        'difference',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
