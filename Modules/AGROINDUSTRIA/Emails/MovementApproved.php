<?php

namespace Modules\AGROINDUSTRIA\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MovementApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $inventory;

    public function __construct($inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title='correo';
        return $this->view('agroindustria::emails.movement_approved', compact('title'))
            ->subject('Movimiento Aprobado');
    }
}
