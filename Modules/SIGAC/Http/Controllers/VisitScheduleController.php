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
use Illuminate\Support\Facades\URL;
use PhpOffice\PhpSpreadsheet\IOFactory;







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
        // 🗓️ Mínimo: desde hoy (Bogotá) + 1 día
        $minDate = \Illuminate\Support\Carbon::today('America/Bogota')->addDay()->toDateString();

        // ⏱️ Normaliza HH:MM:SS → HH:MM
        foreach (['start_time', 'end_time'] as $f) {
            $v = (string) $request->input($f, '');
            if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $v)) {
                $request->merge([$f => substr($v, 0, 5)]);
            }
        }

        // ✅ Validación
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

        // 1) Crear programación
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

        // 2) Actualizar estado de la solicitud
        $visitRequest = \Modules\SIGAC\Entities\VisitRequest::findOrFail($validated['visit_request_id']);
        $visitRequest->state = 'Agendada';
        $visitRequest->save();

        // 3) Destinatario
        $to = $schedule->notification_email ?: $this->bestEmailFromPerson($schedule->personInCharge);
        if (!$to) {
            return redirect()
                ->route('sigac.academic_coordination.dashboard')
                ->with('warning', 'Visita agendada, pero no se envió correo: el encargado no tiene email válido.');
        }

        // 4) Enlace público firmado (expira fin del día de la visita)
        $publicUrl = $this->buildPublicLink($schedule);

        // 5) Enviar correo
        try {
            \Mail::to($to)->send(new \App\Mail\VisitScheduledMail($visitRequest, $schedule, $publicUrl));
            return redirect()
                ->route('sigac.academic_coordination.visitschedule.calendar.general')
                ->with('success', 'Visita agendada correctamente y correo enviado a ' . $to);
        } catch (\Throwable $e) {
            \Log::error('Error enviando correo (store): ' . $e->getMessage(), ['to' => $to, 'schedule_id' => $schedule->id]);
            return redirect()
                ->route('sigac.academic_coordination.visitschedule.calendar.general')
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
                    $rt = $this->runtimeStateForSchedule($v);
                    return [
                        'id'    => 'visit-' . $v->id,
                        'title' => $v->activity ?: 'Visita',
                        'start' => $v->date . 'T' . $v->start_time,
                        'end'   => $v->date . 'T' . $v->end_time,
                        'color' => '#5b9bd5',
                        'extendedProps' => [
                            'activity'         => $v->activity,
                            'environment_name' => $v->environment?->name,
                            // 👇 nuevo
                            'runtime_state'    => $rt['state'],
                            'runtime_color'    => $rt['color'],
                        ],
                    ];
                })
        );
    }

    public function calendarAll()
    {
        $initialDate = now('America/Bogota')->toDateString();

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
        // Filtros opcionales ?from=YYYY-MM-DD&to=YYYY-MM-DD&environment_id=ID&company=texto
        $from          = trim((string) $request->query('from', ''));
        $to            = trim((string) $request->query('to', ''));
        $environmentId = $request->query('environment_id'); // null|int
        $companyLike   = trim((string) $request->query('company', ''));

        $q = \Modules\SIGAC\Entities\VisitSchedule::query()
            ->with([
                'environment:id,name',
                'visitRequest.company:id,name',
            ]);

        if ($from !== '') {
            $q->whereDate('date', '>=', $from);
        }
        if ($to !== '') {
            $q->whereDate('date', '<=', $to);
        }
        if (!empty($environmentId)) {
            $q->where('environment_id', (int) $environmentId);
        }
        if ($companyLike !== '') {
            $needle = '%' . str_replace(' ', '%', $companyLike) . '%';
            $q->whereHas('visitRequest.company', function ($w) use ($needle) {
                $w->where('name', 'like', $needle);
            });
        }

        // Orden sano para calendario
        $q->orderBy('date')->orderBy('start_time');

        $events = $q->get()->map(function ($v) {
            // Texto mostrado en el calendario
            $envName  = $v->environment?->name ?? 'Ambiente';
            $title    = trim(($v->activity ?: 'Visita') . ' — ' . $envName);

            // Empresa (extended)
            $company  = $v->visitRequest?->company?->name ?? 'Empresa';

            // Estado calculado runtime (usa tu helper ya existente)
            $rt = $this->runtimeStateForSchedule($v); // ['state' => ..., 'color' => bootstrapColor]

            return [
                'id'    => 'visit-' . $v->id,
                'title' => $title,
                'start' => $v->date . 'T' . $v->start_time,
                'end'   => $v->date . 'T' . $v->end_time,
                // Color base para FullCalendar; usamos uno fijo y pasamos color “semantic” por extendedProps
                'color' => '#5b9bd5',
                'extendedProps' => [
                    'activity'          => $v->activity,
                    'environment_name'  => $envName,
                    'company'           => $company,
                    'request_id'        => $v->visit_request_id,
                    'observations'      => $v->observations,
                    'date'              => $v->date,
                    'start_time'        => $v->start_time,
                    'end_time'          => $v->end_time,
                    'runtime_state'     => $rt['state'],
                    'runtime_color'     => $rt['color'],
                ],
            ];
        });

        return response()->json($events);
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
        $minDate = \Illuminate\Support\Carbon::today('America/Bogota')->toDateString();

        // ⏱️ Normaliza HH:MM:SS → HH:MM
        foreach (['start_time', 'end_time'] as $f) {
            $v = (string) $request->input($f, '');
            if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $v)) {
                $request->merge([$f => substr($v, 0, 5)]);
            }
        }

        // ✅ Validación
        $validated = $request->validate([
            'date'                => ['sometimes', 'required', 'date', 'after_or_equal:' . $minDate],
            'start_time'          => ['sometimes', 'required', 'date_format:H:i'],
            'end_time'            => ['sometimes', 'required', 'date_format:H:i', 'after:start_time'],
            'environment_id'      => ['sometimes', 'nullable', 'exists:environments,id'],
            'person_in_charge_id' => ['sometimes', 'nullable', 'exists:people,id'],
            'notification_email'  => ['sometimes', 'nullable', 'email'],
            'activity'            => ['sometimes', 'nullable', 'string'],
            'observations'        => ['sometimes', 'nullable', 'string'],
            'change_assignee'     => ['sometimes'], // switch del modal
        ], [
            'date.after_or_equal' => "La fecha debe ser igual o posterior a $minDate.",
            'end_time.after'      => 'La hora de fin debe ser mayor que la hora de inicio.',
        ]);

        // ----- Clonar "antes" para detectar cambios
        $before = $schedule->replicate(['id', 'created_at', 'updated_at']);
        $before->setRelation('environment',    $schedule->environment);
        $before->setRelation('personInCharge', $schedule->personInCharge);
        $before->setRelation('visitRequest',   $schedule->visitRequest);

        // ----- Aplicar cambios (respetando switch "Cambiar encargado")
        $payload = $validated;
        $changeAssignee = $request->boolean('change_assignee', false);
        if (!$changeAssignee) {
            unset($payload['person_in_charge_id'], $payload['notification_email']);
        }

        $schedule->fill($payload);
        $schedule->save();

        // ----- Recargar relaciones / estado
        $schedule->load(['environment', 'personInCharge', 'visitRequest']);
        $schedule->visitRequest?->update(['state' => 'Agendada']);

        // ----- Detectar cambios
        $changes = $this->changedFields($before, $schedule);
        if (empty($changes)) {
            return back()->with('info', 'No hubo cambios en la visita.');
        }

        $event        = (!empty($changes['_schedule_changed'])) ? 'rescheduled' : 'updated';
        $summaryLines = $this->humanizeChanges($changes);

        // ----- Destinatarios
        $recipients = $this->recipientsForUpdate($before, $schedule);

        // 🔗 Enlace público firmado
        $publicUrl = $this->buildPublicLink($schedule);

        // ----- Envío
        try {
            foreach ($recipients as $to) {
                \Mail::to($to)->send(new \App\Mail\VisitUpdateMail(
                    $schedule->visitRequest,
                    $schedule,
                    $changes,
                    $event,
                    $summaryLines,
                    $publicUrl // incluye el enlace en el correo
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
        // ----- Clonar "antes" para detectar cambio de encargado y destinatarios previos
        $before = $schedule->replicate(['id', 'created_at', 'updated_at']);
        $before->setRelation('personInCharge', $schedule->personInCharge);
        $before->setRelation('visitRequest',   $schedule->visitRequest);

        // ----- Actualizar estado de la solicitud
        $schedule->visitRequest?->update(['state' => 'Cancelada']);

        // ----- Guardar motivo en observaciones (acumulando)
        $reason = trim((string) $request->input('reason', ''));
        if ($reason !== '') {
            $schedule->observations = trim(($schedule->observations ? $schedule->observations . "\n" : '') . 'Cancelada: ' . $reason);
        }
        $schedule->save();

        // ----- Recargar relaciones
        $schedule->load(['personInCharge', 'visitRequest', 'environment']);

        // ----- Destinatarios (contacto, nuevo encargado y encargado anterior si cambió)
        $recipients = $this->recipientsForUpdate($before, $schedule);
        if (empty($recipients)) {
            return back()->with('warning', 'La visita fue cancelada, pero no hay destinatarios con correo válido para notificar.');
        }

        // ----- Resumen legible para el correo
        $summaryLines = [
            'La visita fue <strong>cancelada</strong>' . ($reason ? " (motivo: {$reason})" : '') . '.'
        ];

        // 🔗 Enlace público firmado (opcional: deja ver la ficha en estado Cancelada)
        $publicUrl = $this->buildPublicLink($schedule);

        // ----- Enviar correos
        try {
            foreach ($recipients as $to) {
                \Mail::to($to)->send(new \App\Mail\VisitUpdateMail(
                    $schedule->visitRequest,
                    $schedule,
                    ['canceled' => true],
                    'canceled',
                    $summaryLines,
                    $publicUrl // incluye el enlace en el correo
                ));
            }
            return back()->with('success', 'Visita cancelada y notificaciones enviadas.');
        } catch (\Throwable $e) {
            \Log::error('Error enviando notificaciones de cancelación: ' . $e->getMessage(), [
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
        [$fullPath, $mime, $publicUrl] = $this->resolvePeopleList($visit);

        if (!$fullPath || !is_file($fullPath)) {
            return back()->with('error', 'No se encontró el archivo asociado a esta solicitud.');
        }

        // Forzar MIME correcto para Excel si mime_content_type() no lo detecta
        $ext = Str::lower(pathinfo($fullPath, PATHINFO_EXTENSION));
        if ($ext === 'xlsx') {
            $mime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        } elseif ($ext === 'csv') {
            $mime = 'text/csv';
        } elseif (!$mime) {
            $mime = 'application/octet-stream';
        }

        $filename = basename($fullPath);

        // Stream sin cargar el archivo completo en memoria
        return new StreamedResponse(function () use ($fullPath) {
            $fh = fopen($fullPath, 'rb');
            if ($fh !== false) {
                while (!feof($fh)) {
                    echo fread($fh, 8192);
                    @ob_flush();
                    flush();
                }
                fclose($fh);
            }
        }, 200, [
            'Content-Type'        => $mime,
            // inline para intentar abrir en el navegador; cambia a "attachment" si prefieres descarga
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Content-Length'      => (string) filesize($fullPath),
            'X-Content-Type-Options' => 'nosniff',
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
     * Devuelve mapa de cambios con before/after y flags para fácil lectura.
     * @return array<string,mixed>
     */
    private function changedFields(\Modules\SIGAC\Entities\VisitSchedule $before, \Modules\SIGAC\Entities\VisitSchedule $after): array
    {
        $ch = [];

        // Fecha
        if ($before->date !== $after->date) {
            $ch['date'] = [
                'before' => $before->date,
                'after'  => $after->date,
            ];
        }
        // Horas
        if ($before->start_time !== $after->start_time) {
            $ch['start_time'] = [
                'before' => $before->start_time,
                'after'  => $after->start_time,
            ];
        }
        if ($before->end_time !== $after->end_time) {
            $ch['end_time'] = [
                'before' => $before->end_time,
                'after'  => $after->end_time,
            ];
        }

        // Ambiente
        if ((int) $before->environment_id !== (int) $after->environment_id) {
            $ch['environment'] = [
                'before' => optional($before->environment)->name ?? '—',
                'after'  => optional($after->environment)->name ?? '—',
            ];
        }

        // Encargado
        if ((int) $before->person_in_charge_id !== (int) $after->person_in_charge_id) {
            $ch['assignee'] = [
                'before_id' => $before->person_in_charge_id,
                'after_id'  => $after->person_in_charge_id,
                'before'    => optional($before->personInCharge)->first_name
                    ? trim($before->personInCharge->first_name . ' ' . $before->personInCharge->first_last_name) : '—',
                'after'     => optional($after->personInCharge)->first_name
                    ? trim($after->personInCharge->first_name . ' ' . $after->personInCharge->first_last_name) : '—',
            ];
        }

        // Correo de notificación
        if (trim((string)$before->notification_email) !== trim((string)$after->notification_email)) {
            $ch['notification_email'] = [
                'before' => $before->notification_email ?: '—',
                'after'  => $after->notification_email ?: '—',
            ];
        }

        // Actividad
        if (trim((string)$before->activity) !== trim((string)$after->activity)) {
            $ch['activity'] = [
                'before' => $before->activity ?: '—',
                'after'  => $after->activity ?: '—',
            ];
        }

        // Observaciones
        if (trim((string)$before->observations) !== trim((string)$after->observations)) {
            $ch['observations'] = [
                'before' => $before->observations ?: '—',
                'after'  => $after->observations ?: '—',
            ];
        }

        // Flag rápido: ¿hubo cambio de agenda (fecha/hora/ambiente)?
        $ch['_schedule_changed'] = isset($ch['date']) || isset($ch['start_time']) || isset($ch['end_time']) || isset($ch['environment']);

        return $ch;
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
    private function humanizeChanges(array $ch): array
    {
        $lines = [];
        if (isset($ch['date']))            $lines[] = "Se cambió el <strong>día</strong>: {$ch['date']['before']} → {$ch['date']['after']}";
        if (isset($ch['start_time']))      $lines[] = "Se cambió la <strong>hora de inicio</strong>: {$ch['start_time']['before']} → {$ch['start_time']['after']}";
        if (isset($ch['end_time']))        $lines[] = "Se cambió la <strong>hora de fin</strong>: {$ch['end_time']['before']} → {$ch['end_time']['after']}";
        if (isset($ch['environment']))     $lines[] = "Se cambió el <strong>ambiente</strong>: {$ch['environment']['before']} → {$ch['environment']['after']}";
        if (isset($ch['assignee']))        $lines[] = "Se cambió el <strong>encargado</strong>: {$ch['assignee']['before']} → {$ch['assignee']['after']}";
        if (isset($ch['notification_email'])) $lines[] = "Se cambió el <strong>correo de notificación</strong>: {$ch['notification_email']['before']} → {$ch['notification_email']['after']}";
        if (isset($ch['activity']))        $lines[] = "Se cambió la <strong>actividad</strong>: " . ($ch['activity']['before'] ?: '—') . " → " . ($ch['activity']['after'] ?: '—');
        if (isset($ch['observations']))    $lines[] = "Se actualizaron las <strong>observaciones</strong>.";
        return $lines;
    }
    public function invitation(VisitSchedule $schedule)
    {
        $schedule->load(['visitRequest.company', 'environment', 'personInCharge']);
        return view('sigac::visits.invitation', [
            'schedule' => $schedule,
            'visit'    => $schedule->visitRequest,
            'titlePage' => 'Invitación a visita',
            'titleView' => 'Invitación a visita',
        ]);
    }

    public function sendInvitation(Request $request, VisitSchedule $schedule)
    {
        $schedule->load(['visitRequest.company', 'environment', 'personInCharge']);
        $visit = $schedule->visitRequest;

        // destinatarios: contacto + encargado (o correo explícito)
        $to = [];
        if (filter_var($visit->contact_email, FILTER_VALIDATE_EMAIL)) {
            $to[] = $visit->contact_email;
        }
        $assignee = $schedule->notification_email ?: $this->bestEmailFromPerson($schedule->personInCharge);
        if ($assignee) $to[] = $assignee;
        $to = array_values(array_unique($to));

        if (empty($to)) {
            return back()->with('warning', 'No hay correos válidos para enviar la invitación.');
        }

        // Adjuntar .ics
        $ics = \App\Support\IcsBuilder::singleEvent([
            'uid'         => "visit-{$schedule->id}@sicefa.local",
            'summary'     => 'Invitación visita - ' . optional($visit->company)->name,
            'description' => "Actividad: {$schedule->activity}",
            'location'    => optional($schedule->environment)->name ?? 'SENA',
            'start'       => "{$schedule->date} {$schedule->start_time}",
            'end'         => "{$schedule->date} {$schedule->end_time}",
            'organizer'   => config('mail.from.address'),
            'attendees'   => array_filter([$visit->contact_email ?? null, $assignee ?? null]),
        ]);

        try {
            foreach ($to as $addr) {
                \Mail::to($addr)->send(
                    (new \App\Mail\VisitInvitationMail($visit, $schedule))
                        ->attachData($ics, "visita-{$schedule->id}.ics", ['mime' => 'text/calendar'])
                );
            }
            return back()->with('success', 'Invitación enviada correctamente.');
        } catch (\Throwable $e) {
            \Log::error('Error enviando invitación: ' . $e->getMessage(), ['schedule_id' => $schedule->id, 'to' => $to]);
            return back()->with('error', 'No se pudo enviar la invitación: ' . $e->getMessage());
        }
    }
    // En VisitScheduleController
    public function publicView($scheduleId)
{
    \Log::info('publicView hit', ['scheduleId' => $scheduleId]);

    $schedule = VisitSchedule::/*withTrashed()->*/  // ⬅️ quita withTrashed()
        with(['visitRequest.company', 'environment', 'personInCharge'])
        ->findOrFail($scheduleId);

    if ($schedule->date && now('America/Bogota')->gt(\Illuminate\Support\Carbon::parse($schedule->date, 'America/Bogota')->endOfDay())) {
        abort(403, 'Este enlace ya no está disponible.');
    }

    return view('sigac::visitschedule.invitation', [
        'schedule'  => $schedule,
        'visit'     => $schedule->visitRequest,
        'titlePage' => 'Detalle de visita',
        'titleView' => 'Detalle de visita',
    ]);
}

    private function buildPublicLink(\Modules\SIGAC\Entities\VisitSchedule $schedule): string
    {
        $expiresAt = $schedule->date
            ? Carbon::parse($schedule->date, 'America/Bogota')->endOfDay()
            : now('America/Bogota')->addDays(3);

        return URL::temporarySignedRoute('cefa.sigac.visit.public', $expiresAt, [
            'schedule' => $schedule->id,
        ]);
    }
    // === Helpers de estado runtime (no persisten en BD) ===

    /**
     * Estado calculado a partir del último agendamiento de una solicitud.
     * Retorna ['state' => string, 'color' => bootstrapColor].
     */
    private function runtimeStateForVisit(VisitRequest $visit): array
    {
        // Respeta "Cancelada" guardada
        if (strcasecmp((string)$visit->state, 'Cancelada') === 0) {
            return ['state' => 'Cancelada', 'color' => 'danger'];
        }

        $last = VisitSchedule::where('visit_request_id', $visit->id)
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->first();

        if (!$last) {
            return ['state' => 'Sin agendar', 'color' => 'secondary'];
        }

        return $this->runtimeStateForSchedule($last);
    }

    /**
     * Estado calculado para un único schedule.
     * Retorna ['state' => string, 'color' => bootstrapColor].
     */
    private function runtimeStateForSchedule(VisitSchedule $s): array
    {
        $tz  = 'America/Bogota';
        $now = \Illuminate\Support\Carbon::now($tz);
        $day = \Illuminate\Support\Carbon::parse($s->date, $tz);
        $ini = \Illuminate\Support\Carbon::parse("{$s->date} {$s->start_time}", $tz);
        $fin = \Illuminate\Support\Carbon::parse("{$s->date} {$s->end_time}",   $tz);

        // Hoy / En curso / Finalizada / Agendada
        if ($now->lt($day->copy()->startOfDay())) {
            return ['state' => 'Agendada', 'color' => 'primary'];
        }

        if ($now->isSameDay($day)) {
            if ($now->lt($ini))                return ['state' => 'Hoy',       'color' => 'info'];
            if ($now->betweenIncluded($ini, $fin)) return ['state' => 'En curso',  'color' => 'warning'];
            if ($now->gt($fin))                return ['state' => 'Finalizada', 'color' => 'secondary'];
        }

        if ($now->gt($day->copy()->endOfDay())) {
            return ['state' => 'Finalizada', 'color' => 'secondary'];
        }

        return ['state' => 'Agendada', 'color' => 'primary'];
    }
    private function resolvePeopleList(VisitRequest $visit): array
    {
        $raw = trim((string) ($visit->people_list_path ?? ''));
        if ($raw === '') {
            return [null, null, null]; // fullPath, mime, publicUrl
        }

        // Normaliza separadores y limpia prefijos legacy "storage/app/"
        $rel = str_replace('\\', '/', $raw);
        if (\Illuminate\Support\Str::startsWith($rel, ['storage/app/', '/storage/app/'])) {
            $rel = \Illuminate\Support\Str::after($rel, 'storage/app/');
        }

        // 1) Intento en el disco nuevo (sigac_visit -> public/modules/sigac/files/visit)
        $disk = \Storage::disk('public');
        if ($disk->exists($rel)) {
            $full = $disk->path($rel);
            $mime = mime_content_type($full) ?: 'application/octet-stream';
            $url  = $disk->url($rel);
            return [$full, $mime, $url];
        }

        // 2) Fallback legacy (storage/app/…)
        if (\Storage::disk('local')->exists($rel)) {
            $full = storage_path('app/' . $rel);
            $mime = mime_content_type($full) ?: 'application/octet-stream';
            // No hay URL pública directa para legacy; se sirve por controlador
            return [$full, $mime, null];
        }

        // 3) Último intento: por si guardaron la ruta absoluta ya normalizada
        if (is_file($rel)) {
            $mime = mime_content_type($rel) ?: 'application/octet-stream';
            return [$rel, $mime, null];
        }

        return [null, null, null];
    }
    private function peopleListPublicUrl(?VisitRequest $visit): ?string
    {
        if (!$visit) return null;
        $raw = trim((string) ($visit->people_list_path ?? ''));
        if ($raw === '') return null;

        $rel = str_replace('\\', '/', $raw);
        if (\Illuminate\Support\Str::startsWith($rel, ['storage/app/', '/storage/app/'])) {
            $rel = \Illuminate\Support\Str::after($rel, 'storage/app/');
        }

        $disk = \Storage::disk('public');
        return $disk->exists($rel) ? $disk->url($rel) : null;
    }
    public function previewPeopleListHtml(VisitRequest $visit)
    {
        [$fullPath, $mime] = $this->resolvePeopleList($visit);

        if (!$fullPath || !is_file($fullPath)) {
            return back()->with('error', 'No se encontró el archivo asociado a esta solicitud.');
        }

        $ext = Str::lower(pathinfo($fullPath, PATHINFO_EXTENSION));

        // Si es CSV, lo mostramos como tabla simple sin PhpSpreadsheet
        if ($ext === 'csv') {
            $rows = [];
            if (($h = fopen($fullPath, 'r')) !== false) {
                while (($data = fgetcsv($h, 0, ',')) !== false) {
                    $rows[] = $data;
                }
                fclose($h);
            }
            return response()->view('sigac::visitschedule.preview_csv', [
                'rows'       => $rows,
                'filename'   => basename($fullPath),
                'titlePage'  => 'Vista previa del listado',
                'titleView'  => 'Vista previa del listado',
            ]);
        }

        // Para xlsx/xls -> PhpSpreadsheet a HTML
        if (in_array($ext, ['xlsx', 'xls'])) {
            // Requiere ext-zip y (opcional) ext-gd para imágenes
            $spreadsheet = IOFactory::load($fullPath);

            // (Opcional) Solo 1ra hoja: $sheet = $spreadsheet->getSheet(0);
            // $spreadsheet->removeSheetByIndex(...); // si quieres limpiar otras

            $writer = IOFactory::createWriter($spreadsheet, 'Html');

            // Opcional: estilo mínimo en línea
            if (method_exists($writer, 'setPreCalculateFormulas')) {
                $writer->setPreCalculateFormulas(false);
            }

            ob_start();
            $writer->save('php://output');
            $html = ob_get_clean();

            // Envuélvelo en tu layout Blade
            return response()->view('sigac::visitschedule.preview_html', [
                'html'       => $html,
                'filename'   => basename($fullPath),
                'titlePage'  => 'Vista previa del listado', // 👈 agregado
                'titleView'  => 'Vista previa del listado',
            ]);
        }

        // Otros tipos -> descarga inline como fallback
        return response()->file($fullPath, [
            'Content-Type'        => $mime ?: 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"',
        ]);
    }
}
