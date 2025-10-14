<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\SIGAC\Entities\VisitRequest;
use Modules\SIGAC\Entities\VisitSchedule;

class VisitUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visitRequest;
    public $visitSchedule;
    public $changes; // array con diffs
    public $event;   // 'updated' | 'canceled'

    public function __construct(VisitRequest $visitRequest, VisitSchedule $visitSchedule, array $changes, string $event = 'updated')
    {
        $this->visitRequest  = $visitRequest;
        $this->visitSchedule = $visitSchedule;
        $this->changes       = $changes;
        $this->event         = $event;
    }

    public function build()
    {
        $subject = match ($this->event) {
            'canceled' => '❌ Visita cancelada',
            'updated'  => '✏️ Visita actualizada',
            default    => 'Actualización de visita',
        };

        return $this->subject($subject)
            ->view('sigac::emails.visit_updated')
            ->with([
                'visitRequest'  => $this->visitRequest,
                'visitSchedule' => $this->visitSchedule,
                'changes'       => $this->changes,
                'event'         => $this->event,
            ]);
    }
}
