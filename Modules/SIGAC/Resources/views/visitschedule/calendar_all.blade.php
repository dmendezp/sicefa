@extends('sigac::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h2 class="mb-0">Calendario general de visitas</h2>
        </div>

        <div class="card-body">
            {{-- Filtros opcionales --}}
            <form id="filters" class="row g-2 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Desde</label>
                    <input type="date" class="form-control" id="from">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Hasta</label>
                    <input type="date" class="form-control" id="to">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Empresa</label>
                    <input type="text" class="form-control" id="company" placeholder="Nombre de empresa">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" id="btnFilter" class="btn btn-outline-primary w-100">Aplicar</button>
                </div>
            </form>

            <div id="calendar" style="min-height: 820px;"></div>
            <small class="text-muted">Click en un evento para ver detalles de la visita.</small>
        </div>
    </div>

    {{-- Modal detalle --}}
    <div class="modal fade" id="visitDetailModal" tabindex="-1" aria-labelledby="visitDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visitDetailLabel">Detalle de la visita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Empresa</dt>
                        <dd class="col-sm-8" id="md_company">—</dd>

                        <dt class="col-sm-4">Actividad</dt>
                        <dd class="col-sm-8" id="md_activity">—</dd>

                        <dt class="col-sm-4">Ambiente</dt>
                        <dd class="col-sm-8" id="md_environment">—</dd>

                        <dt class="col-sm-4">Fecha</dt>
                        <dd class="col-sm-8" id="md_date">—</dd>

                        <dt class="col-sm-4">Horario</dt>
                        <dd class="col-sm-8" id="md_time">—</dd>

                        <dt class="col-sm-4">Observaciones</dt>
                        <dd class="col-sm-8" id="md_obs">—</dd>

                        <dt class="col-sm-4">Solicitud</dt>
                        <dd class="col-sm-8" id="md_req">
                            {{-- Aquí pondremos #ID y un enlace al calendario por solicitud si lo deseas --}}
                        </dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* === Tarjeta de evento SIGAC === */
        .fc .sigac-event {
            border: none !important;
            border-radius: 12px !important;
            padding: 6px 8px !important;
            color: #fff !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .15);
            overflow: hidden;
            font-size: 12px;
            line-height: 1.25;
        }

        /* Degradados por estado (usamos extendedProps.runtime_color) */
        .sigac-primary {
            background: linear-gradient(135deg, #4F46E5, #3B82F6);
        }

        .sigac-info {
            background: linear-gradient(135deg, #0ea5e9, #22d3ee);
        }

        .sigac-warning {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #1F2937 !important;
        }

        .sigac-secondary {
            background: linear-gradient(135deg, #6b7280, #9ca3af);
        }

        .sigac-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        /* Contenido interno del evento */
        .sigac-ev-time {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .2);
            font-weight: 600;
            margin-right: 6px;
            font-size: 11px;
        }

        .sigac-ev-title {
            font-weight: 700;
            display: inline;
            word-break: break-word;
        }

        .sigac-ev-meta {
            opacity: .9;
            margin-top: 2px;
            font-size: 11px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Vista month: que se vea como “pill” compacto */
        .fc-daygrid-event .sigac-event {
            padding: 4px 6px !important;
            border-radius: 10px !important;
        }
    </style>


    {{-- FullCalendar (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/locales/es.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            function buildEventsUrl() {
                const from = document.getElementById('from').value;
                const to = document.getElementById('to').value;
                const company = document.getElementById('company').value;

                const url = new URL("{{ route('sigac.academic_coordination.visitschedule.events.all') }}", window
                    .location.origin);
                if (from) url.searchParams.set('from', from);
                if (to) url.searchParams.set('to', to);
                if (company) url.searchParams.set('company', company);
                return url.toString();
            }

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                initialDate: '{{ $initialDate }}',
                locale: 'es',
                timeZone: 'America/Bogota',
                firstDay: 1,
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                nowIndicator: true,
                selectable: false,
                editable: false,
                eventOverlap: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                events: buildEventsUrl(),
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                height: 'auto',

                /* 💅 clases para tema según runtime_color (primary/info/warning/secondary/danger) */
                eventClassNames: function(arg) {
                    const xp = arg.event.extendedProps || {};
                    const theme = String(xp.runtime_color || 'primary')
                .toLowerCase(); // viene del backend
                    return ['sigac-event', `sigac-${theme}`]; // usa los estilos que ya pegaste arriba
                },

                /* 🧩 render bonito del contenido del evento */
                eventContent: function(arg) {
                    const e = arg.event;
                    const xp = e.extendedProps || {};
                    const start = e.start,
                        end = e.end;

                    const pad = n => (n < 10 ? '0' : '') + n;
                    const hhmm = d => d ? `${pad(d.getHours())}:${pad(d.getMinutes())}` : '';
                    const time = (start && end) ? `${hhmm(start)}–${hhmm(end)}` : (start ? hhmm(start) :
                        '');

                    const title = (xp.activity || e.title || 'Visita');
                    const meta = [xp.company, xp.environment_name].filter(Boolean).join(' · ');

                    const html = `
          <div class="sigac-event">
            ${time ? `<span class="sigac-ev-time">${time}</span>` : ''}
            <span class="sigac-ev-title">${title}</span>
            ${meta ? `<div class="sigac-ev-meta">${meta}</div>` : ''}
          </div>
        `;
                    return {
                        html
                    };
                },

                eventDisplay: 'block', // que ocupe todo el ancho alto del slot

                // Click en evento -> modal (tu lógica intacta)
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    const ev = info.event;
                    const xp = ev.extendedProps || {};
                    const start = ev.start,
                        end = ev.end;

                    const pad = n => (n < 10 ? '0' : '') + n;
                    const toDate = d => `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
                    const toTime = d => `${pad(d.getHours())}:${pad(d.getMinutes())}`;

                    document.getElementById('md_company').textContent = xp.company ?? '—';
                    document.getElementById('md_activity').textContent = xp.activity ?? ev.title ?? '—';
                    document.getElementById('md_environment').textContent = xp.environment_name ?? '—';
                    document.getElementById('md_date').textContent = start ? toDate(start) : '—';
                    document.getElementById('md_time').textContent = (start && end) ?
                        `${toTime(start)} - ${toTime(end)}` : '—';
                    document.getElementById('md_obs').textContent = xp.observations ?? '—';

                    const reqEl = document.getElementById('md_req');
                    if (xp.request_id) {
                        const urlByReq = @json(route('sigac.academic_coordination.visitschedule.calendar', ['request' => '___ID___']));
                        reqEl.innerHTML =
                            `<a href="${urlByReq.replace('___ID___', xp.request_id)}" target="_blank" rel="noopener">#${xp.request_id}</a>`;
                    } else {
                        reqEl.textContent = '—';
                    }

                    new bootstrap.Modal(document.getElementById('visitDetailModal')).show();
                }
            });


            calendar.render();

            // Aplicar filtros
            document.getElementById('btnFilter').addEventListener('click', function() {
                calendar.removeAllEventSources();
                calendar.addEventSource({
                    url: buildEventsUrl(),
                    method: 'GET'
                });
                calendar.refetchEvents();
            });
        });
    </script>
@endsection
