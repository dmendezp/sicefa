<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GVFF\Entities\Plants;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'plant_id',
        'quantity',
        'purchase_date',
        'total',
        'status',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'status' => 'string',
    ];

    /**
     * Get the user (admin) that made the purchase.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the plant associated with the purchase.
     */
    public function plants()
    {
        return $this->belongsTo(Plants::class, 'plant_id');
    }
}