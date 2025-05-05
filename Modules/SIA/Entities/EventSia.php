<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSia extends Model
{
    use HasFactory, sofftDeletes;

   protected $table = 'events_sia';

   protected $fillable = [
       'role_user_id', 'name', 'imagen_evento', 'location', 'start_date', 'end_date',
       'organizer', 'contact_email', 'contact_phone', 'status',
   ];
    protected $casts = [
        'status' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function roleUser()
    {
        return $this->belongsTo(\App\Models\RoleUser::class, 'role_user_id');
    }
  
    public function user()
    {
        return $this->hasOneThrough(
            \App\Models\User::class,
            \App\Models\RoleUser::class,
            'id', // role_user.id
            'id', // users.id
            'role_user_id', // events_sia.role_user_id
            'user_id' // role_user.user_id
        );
    }
    // Scope para filtrar eventos por rango de fechas
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                  ->orWhereBetween('end_date', [$startDate, $endDate])
                  ->orWhere(function ($query) use ($startDate, $endDate) {
                      $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                  });
        });
    }

    // Scope para eventos próximos
    public function scopeUpcoming($query, $days = 7)
    {
        return $query->where('start_date', '>=', now())
                     ->where('start_date', '<=', now()->addDays($days))
                     ->where('status', 'scheduled')
                     ->orderBy('start_date');
    }

    // Fábrica del modelo
    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\EventSiaFactory::new();
    }
}