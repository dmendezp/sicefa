<?php
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NotificacionCompra extends Notification
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
        return ['database']; // Se guarda en la DB, puedes usar también mail, etc.
    }

    public function toDatabase($notifiable)
    {
        return [
            'productos' => $this->productos,
            'total' => $this->total,
            'fecha' => now()->toDateTimeString()
        ];
    }
}



