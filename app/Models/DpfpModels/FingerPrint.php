<?php

namespace App\Models\DpfpModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FingerPrint extends Model {

    use HasFactory;

    protected $table = "fingerprints";
    public $timestamps = false;
    
    protected $fillable = [
        "id",
        "finger_name",
        "image",
        "fingerprint",
        "notified",
        "person_id"
    ];
        
    
    //Relacion uno a uno Inversa    
    public function person() {
        return $this->belongsTo("Modules\SICA\Entities\Person");
    }

}
