<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\SIGAC\Entities\VisitRequest;
use Modules\SIGAC\Entities\VisitSchedule;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Environment;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\EnvironmentInstructorProgram;
use Modules\SICA\Entities\ClassEnvironment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Support\IcsBuilder;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Mail\VisitScheduledMail;
use App\Mail\VisitUpdateMail;







/**
 * Controlador VisitScheduleController
 *
 * Gestiona la programación (agenda) de las visitas.
 */
class VisitScheduleController extends Controller
{
    /**
     * Mostrar formulario para crear una agenda de visita.
     *
     * @param VisitRequest $request  La solicitud de visita asociada
     */

    public function create(VisitRequest $request)
    {
        // Listar posibles encargados y ambientes
        $persons = Person::all()->mapWithKeys(function ($person) {
            $fullName = trim($person->first_name . ' ' . $person->first_last_name . ' ' . ($person->second_last_name ?? ''));
            return [$person->id => $fullName];
        });
        $environments = Environment::all()->pluck('name', 'id');

        // Listar actividades utilizadas anteriormente para mostrar en datalist
        $activities = VisitSchedule::select('activity')->distinct()->pluck('activity');

        return view('sigac::visitschedule.create', [
            'request'      => $request,
            'persons'      => $persons,
            'environments' => $environments,
            'activities'   => $activities,
            'titlePage'    => 'Agendar visita',
            'titleView'    => 'Agendar visita',
        ]);
    }

    public function searchStaff(Request $request)
    {
        $q    = trim((string) $request->input('q', ''));
        $type = $request->input('type', 'all'); // all | employee | contractor

        if (mb_strlen($q) < 2) {
            return response()->json([]);
        }

        $needle = '%' . str_replace(' ', '%', $q) . '%';

        // Empleados (planta): employees.person_id -> people.id
        $employees = DB::table('employees')
            ->join('people', 'people.id', '=', 'employees.person_id')
            ->where(function ($w) use ($needle) {
                $w->where('people.first_name', 'like', $needle)
                    ->orWhere('people.first_last_name', 'like', $needle)
                    ->orWhere('people.second_last_name', 'like', $needle);
            })
            ->select([
                DB::raw('people.id as person_id'),
                DB::raw("TRIM(CONCAT_WS(' ', people.first_name, people.first_last_name, COALESCE(people.second_last_name,''))) as name"),
                DB::raw("'employee' as type"),
                DB::raw('employees.id as source_id'),
            ]);

        // Contratistas: contractors.person_id -> people.id
        $contractors = DB::table('contractors')
            ->join('people', 'people.id', '=', 'contractors.person_id')
            ->where(function ($w) use ($needle) {
                $w->where('people.first_name', 'like', $needle)
                    ->orWhere('people.first_last_name', 'like', $needle)
                    ->orWhere('people.second_last_name', 'like', $needle);
            })
            ->select([
                DB::raw('people.id as person_id'),
                DB::raw("TRIM(CONCAT_WS(' ', people.first_name, people.first_last_name, COALESCE(people.second_last_name,''))) as name"),
                DB::raw("'contractor' as type"),
                DB::raw('contractors.id as source_id'),
            ]);

        // Unificar según filtro
        if ($type === 'employee') {
            $union = $employees;
        } elseif ($type === 'contractor') {
            $union = $contractors;
        } else {
            $union = $employees->unionAll($contractors);
        }

        // Ordenar y limitar
        $results = DB::query()
            ->fromSub($union, 'u')
            ->orderBy('name')
            ->limit(25)
            ->get();

        return response()->json($results);
    }


    /**
     * Almacenar la agenda de la visita y actualizar el estado de la solicitud.
     */
    public function store(Request $request)
    {
        $minDate = \Illuminate\Support\Carbon::today('America/Bogota')->addDays()->toDateString();

        $validated = $request->validate([
            'visit_request_id'     => 'required|exists:visit_requests,id',
            'person_in_charge_id'  => 'required|exists:people,id',
            'notification_email'   => 'nullable|email',
            'activity'             => 'required|string',
            'date'                 => ['required', 'date', 'after_or_equal:' . $minDate],
            'start_time'           => ['required', 'date_format:H:i'],
            'end_time'             => ['required', 'date_format:H:i', 'after:start_time'],
            'environment_id'       => 'nullable|exists:environments,id',
            'observations'         => 'nullable|string',
        ]);

        // 1️⃣ Crear programación
        $schedule = \Modules\SIGAC\Entities\VisitSchedule::create([
            'visit_request_id'     => $validated['visit_request_id'],
            'person_in_charge_id'  => $validated['person_in_charge_id'],
            'notification_email'   => $validated['notification_email'] ?? null,
            'activity'             => $validated['activity'],
            'date'                 => $validated['date'],
            'start_time'           => $validated['start_time'],
            'end_time'             => $validated['end_time'],
            'environment_id'       => $validated['environment_id'] ?? null,
            'observations'         => $validated['observations'] ?? null,
        ]);

        // 2️⃣ Actualizar solicitud
        $visitRequest = \Modules\SIGAC\Entities\VisitRequest::findOrFail($validated['visit_request_id']);
        $visitRequest->state = 'Agendada';
        $visitRequest->save();

        // 3️⃣ Determinar destinatario
        $to = $schedule->notification_email;
        if (!$to) {
            $to = $this->bestEmailFromPerson($schedule->personInCharge);
        }

        if (!$to) {
            return redirect()
                ->route('sigac.academic_coordination.dashboard')
                ->with('warning', 'Visita agendada, pero no se envió correo: el encargado no tiene email válido.');
        }

        // 4️⃣ Enviar automáticamente
        try {
            Mail::to($to)->send(new VisitScheduledMail($visitRequest, $schedule));
            return redirect()
                ->route('sigac.academic_coordination.dashboard')
                ->with('success', 'Visita agendada correctamente y correo enviado a ' . $to);
        } catch (\Throwable $e) {
            \Log::error('Error enviando correo: ' . $e->getMessage(), ['to' => $to]);
            return redirect()
                ->route('sigac.academic_coordination.dashboard')
                ->with('error', 'Visita agendada, pero el correo no se envió. Detalle: ' . $e->getMessage());
        }
    }


    public function available_environments(Request $request)
    {
        $date       = $request->input('date');
        $start_time = $request->input('start_time');
        $end_time   = $request->input('end_time');

        // 1) Ambientes ocupados por programaciones de clase en la fecha solicitada
        $programIds = InstructorProgram::where('date', $date)->pluck('id');
        $occupiedByClasses = EnvironmentInstructorProgram::whereIn('instructor_program_id', $programIds)
            ->pluck('environment_id');

        // 2) Ambientes ocupados por otras visitas (VisitSchedule) con traslape de horario
        $occupiedByVisits = VisitSchedule::where('date', $date)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time])
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('start_time', '<=', $start_time)
                            ->where('end_time', '>=', $end_time);
                    });
            })
            ->pluck('environment_id');

        // 3) Ambientes externos (opcional: si no deseas considerarlos)
        $externalIds = ClassEnvironment::where('name', 'Externo')->pluck('id');

        // 4) Ambientes libres
        $occupied = $occupiedByClasses->merge($occupiedByVisits)->unique();
        $available = Environment::whereNotIn('id', $occupied)
            ->whereNotIn('class_environment_id', $externalIds)
            ->get();

        // Devuelve la lista como respuesta JSON o como vista parcial,
        // según cómo vayas a consumirla en el frontend
        return response()->json($available->map(function ($env) {
            return ['id' => $env->id, 'name' => $env->name];
        }));
    }
    public function calendar(VisitRequest $request)
    {
        // Buscar los agendamientos de esta solicitud
        $schedules = VisitSchedule::with('environment') // asegúrate de tener relación environment() en el modelo
            ->where('visit_request_id', $request->id)
            ->orderBy('date')
            ->get();

        // Fecha inicial del calendario: la primera fecha agendada, o la fecha de recepción como fallback
        $initialDate = $schedules->first()->date ?? ($request->date_received ?? now()->toDateString());

        return view('sigac::visitschedule.calendar', [
            'visitRequest' => $request,
            'schedules'    => $schedules,
            'initialDate'  => $initialDate,
            'titlePage'    => 'Agenda de la solicitud',
            'titleView'    => 'Agenda de la solicitud',
        ]);
    }
    public function eventsByRequest(VisitRequest $request)
    {
        $events = VisitSchedule::with('environment')
            ->where('visit_request_id', $request->id)
            ->get()
            ->map(function ($v) {
                $env = $v->environment?->name ?? 'Ambiente';
                return [
                    'id'    => 'visit-' . $v->id,
                    'title' => ($v->activity ? $v->activity . ' — ' : '') . $env,
                    'start' => $v->date . 'T' . $v->start_time,
                    'end'   => $v->date . 'T' . $v->end_time,
                    'color' => '#5b9bd5', // azul
                ];
            });

        // En VisitScheduleController@eventsByRequest
        return response()->json(
            VisitSchedule::with('environment')
                ->where('visit_request_id', $request->id)
                ->get()
                ->map(function ($v) {
                    return [
                        'id'    => 'visit-' . $v->id,
                        'title' => $v->activity ?: 'Visita',
                        'start' => $v->date . 'T' . $v->start_time,
                        'end'   => $v->date . 'T' . $v->end_time,
                        'color' => '#5b9bd5',
                        'extendedProps' => [
                            'activity'         => $v->activity,
                            'environment_name' => $v->environment?->name,
                        ],
                    ];
                })
        );
    }

    public function calendarAll()
    {
        // Vista del calendario general (centrado en hoy)
        $initialDate = now()->toDateString();

        return view('sigac::visitschedule.calendar_all', [
            'initialDate' => $initialDate,
            'titlePage'   => 'Calendario general de visitas',
            'titleView'   => 'Calendario general de visitas',
        ]);
    }

    /**
     * Feed de eventos para FullCalendar (todas las visitas).
     * Soporta filtros opcionales por ?from=YYYY-MM-DD&to=YYYY-MM-DD&environment_id=&company=
     */
    public function eventsAll(Request $request)
    {
        $from = $request->query('from'); // opcional
        $to   = $request->query('to');   // opcional

        $q = VisitSchedule::query()
            ->with(['environment', 'visitRequest.company'])
            ->when($from, fn($qq) => $qq->whereDate('date', '>=', $from))
            ->when($to,   fn($qq) => $qq->whereDate('date', '<=', $to))
            ->when($request->query('environment_id'), fn($qq, $envId) => $qq->where('environment_id', $envId))
            ->when($request->query('company'), function ($qq, $companyName) {
                $qq->whereHas('visitRequest.company', function ($c) use ($companyName) {
                    $c->where('name', 'like', "%{$companyName}%");
                });
            })
            ->orderBy('date');

        $events = $q->get()->map(function ($v) {
            $env = $v->environment?->name ?? 'Ambiente';
            $comp = $v->visitRequest?->company?->name ?? 'Empresa';
            $title = trim(($v->activity ?: 'Visita') . ' — ' . $env);

            return [
                'id'    => 'visit-' . $v->id,
                'title' => $title,
                'start' => $v->date . 'T' . $v->start_time,
                'end'   => $v->date . 'T' . $v->end_time,
                'color' => '#5b9bd5', // azul
                'extendedProps' => [
                    'activity'          => $v->activity,
                    'environment_name'  => $env,
                    'company'           => $comp,
                    'request_id'        => $v->visit_request_id,
                    'observations'      => $v->observations,
                    'date'              => $v->date,
                    'start_time'        => $v->start_time,
                    'end_time'          => $v->end_time,
                ],
            ];
        });

        return response()->json($events);
    }

    public function downloadIcs(VisitSchedule $schedule)
    {
        $visitRequest = VisitRequest::find($schedule->visit_request_id);

        $summary = 'Visita - ' . optional($visitRequest->company)->name;
        $description = "Actividad: {$schedule->activity}\n"
            . "Encargado: " . optional($visitRequest->person)->first_name . "\n"
            . "Observaciones: " . ($schedule->observations ?? '—');

        $ics = IcsBuilder::singleEvent([
            'uid'         => "visit-{$schedule->id}@sicefa.local",
            'summary'     => $summary,
            'description' => $description,
            'location'    => optional($schedule->environment)->name ?? 'SENA',
            'start'       => "{$schedule->date} {$schedule->start_time}",
            'end'         => "{$schedule->date} {$schedule->end_time}",
            'organizer'   => config('mail.from.address'),
            'attendees'   => array_filter([
                $visitRequest->contact_email ?? null,
            ]),
        ]);

        $filename = "visita-{$schedule->id}.ics";

        return new StreamedResponse(function () use ($ics) {
            echo $ics;
        }, 200, [
            'Content-Type'        => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
    public function notify(VisitRequest $visit)
    {
        $schedule = VisitSchedule::where('visit_request_id', $visit->id)
            ->with('personInCharge')
            ->latest('id')->first();

        if (!$schedule) {
            return back()->with('error', 'No hay una agenda asociada a esta solicitud.');
        }

        $to = $schedule->notification_email ?: $this->bestEmailFromPerson($schedule->personInCharge);
        if (!$to) {
            return back()->with('error', 'El encargado no tiene correo registrado en People.');
        }

        try {
            \Mail::to($to)->send(new \App\Mail\VisitScheduledMail($visit, $schedule));
            return back()->with('success', 'Notificación enviada a ' . $to);
        } catch (\Throwable $e) {
            \Log::error('Error enviando correo (notify): ' . $e->getMessage(), ['to' => $to, 'schedule_id' => $schedule->id]);
            return back()->with('error', 'No se pudo enviar el correo. Detalle: ' . $e->getMessage());
        }
    }


    public function update(Request $request, VisitSchedule $schedule)
    {
        $minDate = \Illuminate\Support\Carbon::today('America/Bogota')->addDays()->toDateString();

        $validated = $request->validate([
            'date'                 => ['required', 'date', 'after_or_equal:' . $minDate],
            'start_time'           => ['required', 'date_format:H:i'],
            'end_time'             => ['required', 'date_format:H:i', 'after:start_time'],
            'environment_id'       => ['nullable', 'exists:environments,id'],
            'person_in_charge_id'  => ['nullable', 'exists:people,id'],
            'notification_email'   => ['nullable', 'email'],
            'activity'             => ['nullable', 'string'],
            'observations'         => ['nullable', 'string'],
        ], [
            'date.after_or_equal'  => "La fecha debe ser igual o posterior a $minDate.",
            'end_time.after'       => 'La hora de fin debe ser mayor que la hora de inicio.',
        ]);

        // ----- CLONAR ANTES
        $before = $schedule->replicate(['id', 'created_at', 'updated_at']);
        $before->setRelation('environment',   $schedule->environment);
        $before->setRelation('personInCharge', $schedule->personInCharge);
        $before->setRelation('visitRequest',  $schedule->visitRequest);

        // ----- APLICAR CAMBIOS (TODO puede cambiar, incluso encargado/correo)
        $schedule->fill([
            'date'                 => $validated['date'],
            'start_time'           => $validated['start_time'],
            'end_time'             => $validated['end_time'],
            'environment_id'       => $validated['environment_id'] ?? null,
            'person_in_charge_id'  => $validated['person_in_charge_id'] ?? $schedule->person_in_charge_id,
            'notification_email'   => $validated['notification_email'] ?? $schedule->notification_email,
            'activity'             => $validated['activity'] ?? $schedule->activity,
            'observations'         => $validated['observations'] ?? $schedule->observations,
        ]);
        $schedule->save();

        // ----- RECARGAR RELACIONES / ESTADO
        $schedule->load(['environment', 'personInCharge', 'visitRequest']);
        $schedule->visitRequest?->update(['state' => 'Agendada']);

        // ----- DETECTAR CAMBIOS
        $changes = $this->changedFields($before, $schedule);
        if (empty($changes)) {
            return back()->with('info', 'No hubo cambios en la visita.');
        }

        // ----- DEFINIR EVENTO (para asunto y plantilla)
        $event = (isset($changes['schedule']) || isset($changes['environment']))
            ? 'rescheduled'    // hubo cambio de fecha/hora/ambiente → reprogramación
            : 'updated';       // otros cambios (encargado/correo/observaciones/actividad)

        // ----- DESTINATARIOS (contacto + nuevo encargado + anterior si cambió)
        $recipients = $this->recipientsForUpdate($before, $schedule);

        // ----- ENVIAR
        try {
            foreach ($recipients as $to) {
                Mail::to($to)->send(new \App\Mail\VisitUpdateMail(
                    $schedule->visitRequest,
                    $schedule,
                    $changes,
                    $event
                ));
            }
            return back()->with('success', 'Visita actualizada y notificaciones enviadas.');
        } catch (\Throwable $e) {
            \Log::error('Error enviando notificaciones de actualización: ' . $e->getMessage(), [
                'schedule_id' => $schedule->id,
                'recipients'  => $recipients,
            ]);
            return back()->with('warning', 'Visita actualizada, pero falló el envío de correos.');
        }
    }




    /**
     * Cancela la visita y notifica.
     */
    public function cancel(VisitSchedule $schedule, Request $request)
    {
        $before = $schedule->replicate(['id', 'created_at', 'updated_at']);
        $before->setRelation('personInCharge', $schedule->personInCharge);
        $before->setRelation('visitRequest', $schedule->visitRequest);

        $schedule->visitRequest?->update(['state' => 'Cancelada']);

        if ($reason = trim((string)$request->input('reason'))) {
            $schedule->observations = trim(($schedule->observations ? $schedule->observations . "\n" : '') . 'Cancelada: ' . $reason);
            $schedule->save();
        }

        $schedule->load(['personInCharge', 'visitRequest']);

        $recipients = $this->recipientsForUpdate($before, $schedule); // usaremos mismos destinatarios

        try {
            foreach ($recipients as $to) {
                Mail::to($to)->send(new VisitUpdateMail($schedule->visitRequest, $schedule, ['canceled' => true], 'canceled'));
            }
            return back()->with('success', 'Visita cancelada y notificaciones enviadas.');
        } catch (\Throwable $e) {
            Log::error('Error enviando notificaciones de cancelación: ' . $e->getMessage(), [
                'schedule_id' => $schedule->id,
                'recipients'  => $recipients,
            ]);
            return back()->with('warning', 'Visita cancelada, pero falló el envío de correos.');
        }
    }
    /**
     * Envía correos al contacto de la solicitud y al encargado asignado.
     * $event: 'created' | 'updated' | 'canceled'
     */
    private function notifyChanges(\Modules\SIGAC\Entities\VisitSchedule $schedule, array $changed, string $event): array
    {
        // Asegura las relaciones
        $schedule->load(['personInCharge', 'visitRequest']);
        $visit = $schedule->visitRequest;

        // 🔎 DEPURACIÓN (usa dd() temporalmente)
        /*
    dd([
        'schedule_id'    => $schedule->id,
        'visit_id'       => optional($visit)->id,
        'person_id'      => optional($schedule->personInCharge)->id,
        'misena_email'   => optional($schedule->personInCharge)->misena_email,
        'sena_email'     => optional($schedule->personInCharge)->sena_email,
        'personal_email' => optional($schedule->personInCharge)->personal_email,
        'contact_email'  => optional($visit)->contact_email,
    ]);
       */
        // Valida y normaliza el correo de contacto
        $contactEmail  = $this->isValidEmail(optional($visit)->contact_email) ? strtolower(trim($visit->contact_email)) : null;
        // Toma el correo del encargado con prioridad y validación
        $assigneeEmail = $this->getPersonEmail($schedule->personInCharge);

        // Log de diagnóstico (deja esto aunque quites el dd)
        \Log::info('SIGAC notifyChanges()', [
            'visit_id'        => optional($visit)->id,
            'schedule_id'     => $schedule->id,
            'contact_email'   => $contactEmail,
            'assignee_person' => optional($schedule->personInCharge)->id,
            'misena_email'    => optional($schedule->personInCharge)->misena_email,
            'sena_email'      => optional($schedule->personInCharge)->sena_email,
            'personal_email'  => optional($schedule->personInCharge)->personal_email,
            'assignee_email'  => $assigneeEmail,
            'event'           => $event,
        ]);

        $sent = [];
        $skipped = [];

        // Evita duplicados y nulos
        $targets = array_filter([
            'Contacto'  => $contactEmail,
            'Encargado' => $assigneeEmail,
        ]);

        foreach ($targets as $label => $to) {
            try {
                \Mail::to($to)->send(new \App\Mail\VisitUpdateMail($visit, $schedule, $event, $changed));
                $sent[] = $label;
            } catch (\Throwable $e) {
                \Log::warning("Fallo enviando correo a {$label} ({$to}): " . $e->getMessage());
                $skipped[] = $label;
            }
        }

        // Si alguno vino vacío lo marcamos como omitido
        foreach (['Contacto', 'Encargado'] as $lbl) {
            if (!isset($targets[$lbl])) $skipped[] = $lbl;
        }

        return ['sent' => $sent, 'skipped' => $skipped];
    }




    /**
     * Extrae email desde People (ajusta campo si en tu esquema es distinto).
     */
    private function getPersonEmail($person): ?string
    {
        if (!$person) return null;

        $candidates = [
            $person->misena_email ?? null,
            $person->sena_email ?? null,
            $person->personal_email ?? null,
        ];

        foreach ($candidates as $mail) {
            if ($this->isValidEmail($mail)) {
                return strtolower(trim($mail));
            }
        }
        return null;
    }

    private function isValidEmail($value): bool
    {
        if (!is_string($value)) return false;
        $value = trim($value);
        if ($value === '') return false;
        return (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function viewPeopleList(VisitRequest $visit)
    {
        $excelPathRaw = (string) ($visit->people_list_path ?? '');
        if ($excelPathRaw === '') {
            return back()->with('error', 'No hay archivo asociado a esta solicitud.');
        }

        // Normaliza separadores y elimina prefijo "storage/app/" si viene así guardado
        $excelPath = str_replace('\\', '/', $excelPathRaw);
        if (Str::startsWith($excelPath, ['storage/app/', '/storage/app/'])) {
            $excelPath = Str::after($excelPath, 'storage/app/');
        }

        if (!Storage::disk('local')->exists($excelPath)) {
            return back()->with('error', 'El archivo no existe en el almacenamiento.');
        }

        $fullPath = storage_path('app/' . $excelPath);
        $mime = mime_content_type($fullPath) ?: 'application/octet-stream';

        // Servir inline (si el navegador no puede, propondrá descarga)
        return response()->file($fullPath, [
            'Content-Type'        => $mime,
            'Content-Disposition' => 'inline; filename="' . basename($excelPath) . '"',
        ]);
    }
    private function bestEmailFromPerson(?Person $p): ?string
    {
        if (!$p) return null;
        foreach (['sena_email', 'misena_email', 'personal_email'] as $f) {
            $v = trim((string)($p->$f ?? ''));
            if ($v && filter_var($v, FILTER_VALIDATE_EMAIL)) return $v;
        }
        return null;
    }

    public function personEmails(Person $person)
    {
        // Ajusta nombres de campos si varían
        $candidates = [
            'sena_email'    => trim((string)($person->sena_email ?? '')),
            'misena_email'  => trim((string)($person->misena_email ?? '')),
            'personal_email' => trim((string)($person->personal_email ?? '')),
        ];

        $emails = [];
        foreach ($candidates as $label => $value) {
            if ($value && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $emails[] = ['label' => $label, 'email' => $value];
            }
        }

        return response()->json($emails); // [{label,email}, ...]
    }

    /**
     * Devuelve qué campos relevantes cambiaron.
     * @return array<string, mixed>
     */
    private function changedFields(\Modules\SIGAC\Entities\VisitSchedule $before, \Modules\SIGAC\Entities\VisitSchedule $after): array
    {
        $changes = [];

        // Cambio de horario (fecha/hora)
        if ($before->date !== $after->date || $before->start_time !== $after->start_time || $before->end_time !== $after->end_time) {
            $changes['schedule'] = [
                'before' => "{$before->date} {$before->start_time} - {$before->end_time}",
                'after'  => "{$after->date} {$after->start_time} - {$after->end_time}",
            ];
        }

        // Cambio de ambiente
        if ((int) $before->environment_id !== (int) $after->environment_id) {
            $changes['environment'] = [
                'before' => optional($before->environment)->name ?? '—',
                'after'  => optional($after->environment)->name ?? '—',
            ];
        }

        // Cambio de encargado
        if ((int) $before->person_in_charge_id !== (int) $after->person_in_charge_id) {
            $changes['assignee'] = [
                'before' => optional($before->personInCharge)->first_name
                    ? trim($before->personInCharge->first_name . ' ' . $before->personInCharge->first_last_name) : '—',
                'after'  => optional($after->personInCharge)->first_name
                    ? trim($after->personInCharge->first_name . ' ' . $after->personInCharge->first_last_name) : '—',
            ];
        }

        // Cambio de correo de notificación
        if (trim((string)$before->notification_email) !== trim((string)$after->notification_email)) {
            $changes['notification_email'] = [
                'before' => $before->notification_email ?: '—',
                'after'  => $after->notification_email ?: '—',
            ];
        }

        return $changes;
    }
    /**
     * @return array<string> correos únicos
     */
    private function recipientsForUpdate(VisitSchedule $before, VisitSchedule $after): array
    {
        $emails = [];

        // contacto de la solicitud
        $contactEmail = filter_var($after->visitRequest->contact_email, FILTER_VALIDATE_EMAIL) ? $after->visitRequest->contact_email : null;
        if ($contactEmail) $emails[] = $contactEmail;

        // correo nuevo elegido (o bestEmail del nuevo encargado)
        $newAssigneeEmail = $after->notification_email ?: $this->bestEmailFromPerson($after->personInCharge);
        if ($newAssigneeEmail) $emails[] = $newAssigneeEmail;

        // si cambió el encargado, notificar al anterior también
        if ((int)$before->person_in_charge_id !== (int)$after->person_in_charge_id) {
            $oldAssigneeEmail = $this->bestEmailFromPerson($before->personInCharge);
            if ($oldAssigneeEmail) $emails[] = $oldAssigneeEmail;
        }

        // únicos
        return array_values(array_unique($emails));
    }
}
