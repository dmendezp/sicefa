<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSia extends Model
{
    use SoftDeletes;

    protected $table = 'events_sia';

    protected $fillable = [
        'name',
        'event_image',
        'location',
        'start_date',
        'end_date',
        'organizer',
        'contact_email',
        'contact_phone',
        'status',
    ];

    protected $dates = ['start_date', 'end_date', 'deleted_at'];

    /**
     * Verifica si el evento está activo (no eliminado ni cancelado).
     */
    public function isActive()
    {
        return !$this->trashed() && $this->status !== 'cancelled';
    }

    /**
     * Método para eliminar lógicamente el registro.
     */
    public function remove()
    {
        return $this->delete();
    }

    /**
     * Muestra la información del evento.
     */
    public function mostrarEvento()
    {
        return [
            'nombre del evento' => $this->name ?? trans('sia::general.not_defined'),
            'imagen del evento' => $this->event_image ?? trans('sia::general.not_defined'),
            'ubicacion' => $this->location ?? trans('sia::general.not_defined'),
            'fecha_inicio' => $this->start_date ? $this->start_date->format('Y-m-d') : trans('sia::general.not_defined'),
            'fecha_fin' => $this->end_date ? $this->end_date->format('Y-m-d') : trans('sia::general.not_defined'),
            'organizador' => $this->organizer ?? trans('sia::general.not_defined'),
            'correo electronico' => $this->contact_email ?? trans('sia::general.not_defined'),
            'numero celular' => $this->contact_phone ?? trans('sia::general.not_defined'),
            'estado' => $this->status ?? trans('sia::general.not_defined'),
        ];
    }
}