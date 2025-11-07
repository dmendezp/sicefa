<?php

namespace App\Support;

use Carbon\Carbon;

class IcsBuilder
{
    public static function singleEvent(array $data): string
    {
        // $data: ['uid','summary','description','location','start','end','organizer','attendees' => ['mail@...','...']]
        $dtStamp = Carbon::now('UTC')->format('Ymd\THis\Z');
        $dtStart = Carbon::parse($data['start'])->utc()->format('Ymd\THis\Z');
        $dtEnd   = Carbon::parse($data['end'])->utc()->format('Ymd\THis\Z');

        $uid     = $data['uid'] ?? uniqid('sicefa-', true) . '@sicefa.local';
        $summary = self::escape($data['summary'] ?? 'Evento SICEFA');
        $desc    = self::escape($data['description'] ?? '');
        $loc     = self::escape($data['location'] ?? '');
        $org     = $data['organizer'] ?? null;
        $atts    = $data['attendees'] ?? [];

        $lines = [
            'BEGIN:VCALENDAR',
            'PRODID:-//SICEFA//ES//',
            'VERSION:2.0',
            'CALSCALE:GREGORIAN',
            'METHOD:REQUEST',
            'BEGIN:VEVENT',
            "DTSTAMP:$dtStamp",
            "DTSTART:$dtStart",
            "DTEND:$dtEnd",
            "UID:$uid",
            "SUMMARY:$summary",
            "DESCRIPTION:$desc",
            "LOCATION:$loc",
        ];

        if ($org) {
            $lines[] = 'ORGANIZER;CN=SICEFA:mailto:' . $org;
        }
        foreach ($atts as $email) {
            $lines[] = 'ATTENDEE;RSVP=TRUE;ROLE=REQ-PARTICIPANT:mailto:' . $email;
        }

        $lines[] = 'END:VEVENT';
        $lines[] = 'END:VCALENDAR';

        return implode("\r\n", $lines);
    }

    protected static function escape(string $text): string
    {
        // Escapes per RFC5545
        $text = str_replace('\\', '\\\\', $text);
        $text = str_replace("\n", '\\n', $text);
        $text = str_replace(',', '\,', $text);
        $text = str_replace(';', '\;', $text);
        return $text;
    }
}
