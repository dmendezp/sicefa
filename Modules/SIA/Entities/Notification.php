<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\SICA\Entities\Role;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['role_user_id', 'type', 'status', 'sent_at', 'retry_count'];
    protected $casts = [
        'type' => 'string',
        'status' => 'string',
        'sent_at' => 'datetime',
        'retry_count' => 'integer',
    ];

    public function roleUser(): BelongsTo
    {
        return $this->belongsTo(Role::class . 'User', 'role_user_id');
    }
}