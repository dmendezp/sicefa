<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Pig extends Model
{
    use HasFactory;
    protected $table = 'pigs'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_pig'; //
    public $timestamps = true; // Habilitar timestamps (created_at, updated_at)


    protected $fillable = ['birth_date', 'initial_weight', 'gender', 'mother_id', 'status', 'weaning_date', 'sale_date',];
}
