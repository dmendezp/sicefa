<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CompraRealizadaNotification extends Notification
{
    protected $productos;
    protected $total;

    public function __construct($productos, $total)
    {
        $this->productos = $productos;
        $this->total = $total;
    }

    public function via($notifiable)
    {
        return ['database']; // 💥 muy importante
    }

    public function toDatabase($notifiable)
    {
        return [
            'titulo' => 'Nueva compra realizada',
            'productos' => $this->productos,
            'total' => $this->total,
            'fecha' => now()->toDateTimeString()
        ];
    }
}

