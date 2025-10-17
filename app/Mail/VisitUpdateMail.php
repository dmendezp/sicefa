<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\SIGAC\Entities\VisitRequest;
use Modules\SIGAC\Entities\VisitSchedule;

// App\Mail\VisitUpdateMail.php
class VisitUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public VisitRequest $visitRequest;
    public VisitSchedule $visitSchedule;
    public array $changes;
    public string $event;
    public array $summaryLines;
    public ?string $publicUrl;   // 👈

    public function __construct(
        VisitRequest $visitRequest,
        VisitSchedule $visitSchedule,
        array $changes = [],
        string $event = 'updated',
        array $summaryLines = [],
        ?string $publicUrl = null   // 👈
    ) {
        $this->visitRequest  = $visitRequest->load(['company']);
        $this->visitSchedule = $visitSchedule->load(['environment','personInCharge']);
        $this->changes       = $changes;
        $this->event         = $event;
        $this->summaryLines  = $summaryLines;
        $this->publicUrl     = $publicUrl; // 👈
    }

    public function build()
    {
        $subject = match ($this->event) {
            'canceled'    => '⚠️ Visita cancelada',
            'rescheduled' => '🗓️ Visita reprogramada',
            default       => '✏️ Actualización de visita',
        };

        return $this->subject($subject)
            ->view('sigac::emails.visit_updated', [
                'visitRequest'  => $this->visitRequest,
                'visitSchedule' => $this->visitSchedule,
                'changes'       => $this->changes,
                'event'         => $this->event,
                'summaryLines'  => $this->summaryLines,
                'publicUrl'     => $this->publicUrl, // 👈
            ]);
    }
}

