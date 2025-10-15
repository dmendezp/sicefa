<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\SIGAC\Entities\VisitRequest;
use Modules\SIGAC\Entities\VisitSchedule;

class VisitUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public VisitRequest $visitRequest;
    public VisitSchedule $visitSchedule;
    public array $changes;
    public string $event;          // 'updated' | 'rescheduled' | 'canceled'
    public array $summaryLines;    // frases legibles (opcional)

    public function __construct(
        VisitRequest $visitRequest,
        VisitSchedule $visitSchedule,
        array $changes = [],
        string $event = 'updated',
        array $summaryLines = []
    ) {
        $this->visitRequest  = $visitRequest->load(['company']);
        $this->visitSchedule = $visitSchedule->load(['environment','personInCharge']);
        $this->changes       = $changes;
        $this->event         = $event;
        $this->summaryLines  = $summaryLines;
    }

    public function build()
    {
        $subject = match ($this->event) {
            'canceled'    => '⚠️ Visita cancelada',
            'rescheduled' => '🗓️ Visita reprogramada',
            default       => '✏️ Actualización de visita',
        };

        return $this->subject($subject)
            // 👇 Usa la vista del módulo con su namespace
            ->view('sigac::emails.visit_updated', [
                'visitRequest'   => $this->visitRequest,
                'visitSchedule'  => $this->visitSchedule,
                'changes'        => $this->changes,
                'event'          => $this->event,
                'summaryLines'   => $this->summaryLines,
            ]);
    }
}
