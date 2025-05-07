<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['name', 'email', 'phone', 'type'];
    protected $casts = [
        'type' => 'string',
    ];
}