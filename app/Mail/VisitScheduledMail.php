<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\SIGAC\Entities\VisitRequest;
use Modules\SIGAC\Entities\VisitSchedule;

// App\Mail\VisitScheduledMail.php
class VisitScheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visitRequest;
    public $visitSchedule;
    public string $publicUrl;   // 👈

    public function __construct(VisitRequest $visitRequest, VisitSchedule $visitSchedule, string $publicUrl)
    {
        $this->visitRequest  = $visitRequest;
        $this->visitSchedule = $visitSchedule;
        $this->publicUrl     = $publicUrl; // 👈
    }

    public function build()
    {
        return $this->subject('📅 Nueva visita agendada')
            ->view('sigac::emails.visit_scheduled')
            ->with([
                'visitRequest'  => $this->visitRequest,
                'visitSchedule' => $this->visitSchedule,
                'publicUrl'     => $this->publicUrl, // 👈
            ]);
    }
}

