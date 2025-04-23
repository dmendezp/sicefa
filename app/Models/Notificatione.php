<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificatione extends Model
{
    protected $table = 'notificationes';
    protected $fillable = ['producto', 'total', 'fecha'];
    public $timestamps = false; // Si tu tabla no tiene campos created_at y updated_at
}