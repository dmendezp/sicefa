<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\SIGAC\Entities\VisitRequest;
use Modules\SIGAC\Entities\VisitSchedule;

class VisitScheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visitRequest;
    public $visitSchedule;

    /**
     * Crea una nueva instancia del mensaje.
     */
    public function __construct(VisitRequest $visitRequest, VisitSchedule $visitSchedule)
    {
        $this->visitRequest = $visitRequest;
        $this->visitSchedule = $visitSchedule;
    }

    /**
     * Construye el mensaje.
     */
    public function build()
    {
        return $this->subject('📅 Nueva visita agendada')
                    ->view('sigac::emails.visit_scheduled') // 👈 vista del correo
                    ->with([
                        'visitRequest'  => $this->visitRequest,
                        'visitSchedule' => $this->visitSchedule,
                    ]);
    }
}
