<?php

namespace App\Models\DpfpModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempFingerprint extends Model {

    use HasFactory;

    protected $table = "temp_fingerprint";
    
    protected $fillable = [
        "id",
        "person_id",
        "token_pc",
        "finger_name",
        "image",
        "fingerprint",
        "option",
        "created_at",
        "updated_at",
        "name",
        "user_id_number"
    ];

}
