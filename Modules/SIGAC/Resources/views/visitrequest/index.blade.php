@extends('sigac::layouts.master')

{{-- Si tu layout YA trae Bootstrap/Icons, puedes quitar estos CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h2 class="mb-0">{{ trans('sigac::visits.title.create_application') }}</h2>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>{{ trans('sigac::visits.alert.check_data') }}</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>{{ trans('sigac::visits.modal.company') }}</th>
                        <th>NIT</th>
                        <th>{{ trans('sigac::visits.index.Applicant') }}</th>
                        <th>{{ trans('sigac::visits.title.create_request') }}</th>
                        <th>{{ trans('sigac::visits.modal.type') }}</th>
                        <th>{{ trans('sigac::visits.modal.state') }}</th>
                        <th>{{ trans('sigac::visits.people.count') }}</th>
                        <th style="width: 420px;">{{ trans('sigac::visits.index.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitRequests as $visit)
                        @php
                            // ===== Variables por fila =====
                            $hasEmail     = filled($visit->contact_email);
                            $lastSchedule = optional($visit->schedules)->last();
                            $scheduleId   = $lastSchedule->id ?? null;

                            // ===== Excel (nuevo disco + legacy) =====
                            $excelPathRaw = (string) ($visit->people_list_path ?? '');
                            $excelPath = str_replace('\\', '/', $excelPathRaw);
                            if (\Illuminate\Support\Str::startsWith($excelPath, ['storage/app/', '/storage/app/'])) {
                                $excelPath = \Illuminate\Support\Str::after($excelPath, 'storage/app/');
                            }
                            $existsNew    = $excelPath && \Illuminate\Support\Facades\Storage::disk('public')->exists($excelPath);
                            $existsLegacy = $excelPath && \Illuminate\Support\Facades\Storage::disk('local')->exists($excelPath);
                            $canViewExcel = $existsNew || $existsLegacy;

                            // ===== Estado runtime (clave + color + label traducible) =====
                            $tz  = 'America/Bogota';
                            $now = \Illuminate\Support\Carbon::now($tz);

                            $rtKey   = 'unscheduled';   // claves: cancelled|scheduled|today|in_progress|finished|unscheduled
                            $rtColor = 'secondary';     // badge BS
                            $rtLabel = trans('sigac::visits.index.Unscheduled'); // texto por defecto

                            if (!$lastSchedule) {
                                $rtKey   = 'unscheduled';
                                $rtColor = 'secondary';
                                $rtLabel = trans('sigac::visits.index.Unscheduled');
                            } else {
                                $day = \Illuminate\Support\Carbon::parse($lastSchedule->date, $tz);
                                $ini = \Illuminate\Support\Carbon::parse($lastSchedule->date.' '.$lastSchedule->start_time, $tz);
                                $fin = \Illuminate\Support\Carbon::parse($lastSchedule->date.' '.$lastSchedule->end_time, $tz);

                                if (strcasecmp((string) $visit->state, 'Cancelada') === 0) {
                                    $rtKey   = 'cancelled';
                                    $rtColor = 'danger';
                                    $rtLabel = trans('sigac::visits.index.Cancel');
                                } elseif ($now->lt($day->copy()->startOfDay())) {
                                    $rtKey   = 'scheduled';
                                    $rtColor = 'primary';
                                    $rtLabel = trans('sigac::visits.index.Scheduled');
                                } elseif ($now->isSameDay($day)) {
                                    if ($now->lt($ini)) {
                                        $rtKey   = 'today';
                                        $rtColor = 'info';
                                        $rtLabel = trans('sigac::visits.index.Today');
                                    } elseif ($now->between($ini, $fin, true)) {
                                        $rtKey   = 'in_progress';
                                        $rtColor = 'warning';
                                        $rtLabel = trans('sigac::visits.index.In_progress');
                                    } else {
                                        $rtKey   = 'finished';
                                        $rtColor = 'secondary';
                                        $rtLabel = trans('sigac::visits.index.Finish');
                                    }
                                } elseif ($now->gt($day->copy()->endOfDay())) {
                                    $rtKey   = 'finished';
                                    $rtColor = 'secondary';
                                    $rtLabel = trans('sigac::visits.index.Finish');
                                } else {
                                    $rtKey   = 'scheduled';
                                    $rtColor = 'primary';
                                    $rtLabel = trans('sigac::visits.index.Scheduled');
                                }
                            }

                            // Chip “Próxima ≤ 24h” (solo si está "scheduled" futuro)
                            $soonBadge = null;
                            if ($lastSchedule) {
                                $startDiffH = \Illuminate\Support\Carbon::parse($lastSchedule->date.' '.$lastSchedule->start_time, $tz)
                                    ->diffInHours($now, false);
                                if ($startDiffH < 0 && abs($startDiffH) <= 24 && $rtKey === 'scheduled') {
                                    $soonBadge = trans('sigac::visits.badge.soon_24h'); // e.g. "Próxima ≤ 24h"
                                }
                            }
                        @endphp

                        <tr data-state-key="{{ $rtKey }}" data-state-label="{{ $rtLabel }}" data-visit-id="{{ $visit->id }}">
                            <td>{{ $visit->id }}</td>
                            <td>{{ $visit->company->name }}</td>
                            <td>{{ $visit->company->nit ?? '—' }}</td>
                            <td>{{ $visit->person->full_name ?? '—' }}</td>
                            <td>{{ $visit->date_received }}</td>
                            <td class="text-capitalize">{{ $visit->type }}</td>
                            <td>
                                <span class="badge bg-{{ $rtColor }}">{{ $rtLabel }}</span>
                                @if ($soonBadge)
                                    <span class="badge bg-warning text-dark ms-1">{{ $soonBadge }}</span>
                                @endif
                            </td>
                            <td>{{ $visit->number_of_people ?? '—' }}</td>

                            <td>
                                <div class="d-flex gap-2 flex-wrap align-items-center js-actions" role="group"
                                     aria-label="{{ trans('sigac::visits.index.Actions') }} #{{ $visit->id }}">
                                    {{-- 👁️ Ver (abre modal) --}}
                                    <button type="button"
                                        class="btn btn-light btn-icon shadow-sm js-tip"
                                        title="{{ trans('sigac::visits.actions.view_detail') }}"
                                        data-bs-title="{{ trans('sigac::visits.actions.view_detail') }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $visit->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    {{-- 🗓️ Agendar / 🔄 Reprogramar / ❌ Cancelar --}}
                                    @if (!$lastSchedule)
                                        <a href="{{ route('sigac.academic_coordination.visitschedule.create', ['request' => $visit->id]) }}"
                                            class="btn btn-primary btn-icon shadow-sm"
                                            data-bs-title="{{ trans('sigac::visits.actions.schedule') }}">
                                            <i class="bi bi-calendar-plus"></i>
                                        </a>
                                    @else
                                        @if ($scheduleId)
                                            <button type="button" class="btn btn-warning btn-icon shadow-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#reprogram-{{ $scheduleId }}"
                                                data-bs-title="{{ trans('sigac::visits.actions.reschedule') }}">
                                                <i class="bi bi-calendar2-event"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-icon shadow-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#cancel-{{ $scheduleId }}"
                                                data-bs-title="{{ trans('sigac::visits.actions.cancel_visit') }}">
                                                <i class="bi bi-x-octagon"></i>
                                            </button>
                                        @endif
                                    @endif

                                    {{-- 👁️ Vista previa HTML del Excel + 📎 Archivo original --}}
                                    @if ($canViewExcel)
                                        <a href="{{ \Illuminate\Support\Facades\URL::temporarySignedRoute(
                                                'sigac.academic_coordination.visits.peoplelist.preview',
                                                now()->addMinutes(30),
                                                ['visit' => $visit->id],
                                            ) }}"
                                           class="btn btn-outline-success btn-icon shadow-sm"
                                           target="_blank" rel="noopener"
                                           data-bs-title="{{ trans('sigac::visits.actions.preview_excel') }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ \Illuminate\Support\Facades\URL::temporarySignedRoute(
                                                'sigac.academic_coordination.visits.peoplelist.view',
                                                now()->addDays(7),
                                                ['visit' => $visit->id],
                                            ) }}"
                                           class="btn btn-success btn-icon shadow-sm" target="_blank" rel="noopener"
                                           data-bs-title="{{ trans('sigac::visits.actions.open_excel') }}">
                                            <i class="bi bi-file-earmark-excel"></i>
                                        </a>
                                    @else
                                        <button class="btn btn-secondary btn-icon shadow-sm" disabled
                                                data-bs-title="{{ trans('sigac::visits.actions.no_file') }}">
                                            <i class="bi bi-file-earmark-x"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        {{-- ============ MODALES (render fuera de la tabla) ============ --}}
                        @push('modals')
                            {{-- 📄 Modal Detalle --}}
                            <div class="modal fade" id="modal{{ $visit->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ trans('sigac::visits.modal.request') }} #{{ $visit->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-4">{{ trans('sigac::visits.modal.company') }}</dt>
                                                <dd class="col-sm-8">{{ $visit->company->name }}</dd>

                                                <dt class="col-sm-4">{{ trans('sigac::visits.modal.contact') }}</dt>
                                                <dd class="col-sm-8">{{ $visit->contact_name ?? '—' }}</dd>

                                                <dt class="col-sm-4">{{ trans('sigac::visits.contact.email') }}</dt>
                                                <dd class="col-sm-8">{{ $visit->contact_email ?? '—' }}</dd>

                                                <dt class="col-sm-4">{{ trans('sigac::visits.modal.phone') }}</dt>
                                                <dd class="col-sm-8">{{ $visit->contact_phone ?? '—' }}</dd>

                                                <dt class="col-sm-4">{{ trans('sigac::visits.modal.type') }}</dt>
                                                <dd class="col-sm-8 text-capitalize">{{ $visit->type }}</dd>

                                                @if ($visit->type === 'practica')
                                                    <dt class="col-sm-4">{{ trans('sigac::visits.practice.requirements.label') }}</dt>
                                                    <dd class="col-sm-8">{{ $visit->practice_requirements ?? '—' }}</dd>
                                                @endif

                                                <dt class="col-sm-4">{{ trans('sigac::visits.modal.observations') }}</dt>
                                                <dd class="col-sm-8">{{ $visit->observations ?? '—' }}</dd>
                                            </dl>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                {{ trans('sigac::visits.actions.close') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($scheduleId)
                                @php $sch = $lastSchedule; @endphp

                                {{-- 🔄 Modal Reprogramar --}}
                                <div class="modal fade" id="reprogram-{{ $scheduleId }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('sigac.academic_coordination.visitschedule.update', $scheduleId) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ trans('sigac::visits.actions.reschedule') }} — {{ trans('sigac::visits.modal.request') }} #{{ $visit->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-12 col-md-4">
                                                            <label class="form-label">{{ trans('sigac::visits.fields.day') }}</label>
                                                            <input type="date" name="date" class="form-control" value="{{ $sch->date }}" required>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <label class="form-label">{{ trans('sigac::visits.fields.start') }}</label>
                                                            <input type="time" name="start_time" class="form-control" value="{{ $sch->start_time }}" required>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <label class="form-label">{{ trans('sigac::visits.fields.end') }}</label>
                                                            <input type="time" name="end_time" class="form-control" value="{{ $sch->end_time }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">{{ trans('sigac::visits.fields.activity') }} ({{ trans('sigac::visits.common.optional') }})</label>
                                                            <input type="text" name="activity" class="form-control" value="{{ $sch->activity }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">{{ trans('sigac::visits.fields.environment') }} ({{ trans('sigac::visits.common.optional') }})</label>
                                                            <select name="environment_id" class="form-select">
                                                                <option value="">{{ trans('sigac::visits.common.assign_later') }}</option>
                                                                @foreach ($environments ?? [] as $envId => $envName)
                                                                    <option value="{{ $envId }}" @selected($sch->environment_id == $envId)>{{ $envName }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">{{ trans('sigac::visits.fields.observations') }} ({{ trans('sigac::visits.common.optional') }})</label>
                                                        <textarea name="observations" rows="2" class="form-control">{{ $sch->observations }}</textarea>
                                                    </div>

                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input js-toggle-assign" type="checkbox"
                                                               id="toggle-assign-{{ $scheduleId }}" data-schedule="{{ $scheduleId }}">
                                                        <label class="form-check-label" for="toggle-assign-{{ $scheduleId }}">
                                                            {{ trans('sigac::visits.actions.change_assignee') }}
                                                        </label>
                                                    </div>

                                                    <input type="hidden" name="change_assignee" id="change-assignee-{{ $scheduleId }}" value="0">

                                                    <div id="assign-box-{{ $scheduleId }}" class="border rounded p-3" style="display:none;">
                                                        <div class="row g-2 align-items-end">
                                                            <div class="col-md-3">
                                                                <label class="form-label">{{ trans('sigac::visits.fields.type') }}</label>
                                                                <select class="form-select js-staff-type" data-schedule="{{ $scheduleId }}" disabled>
                                                                    <option value="all">{{ trans('sigac::visits.people.types.all') }}</option>
                                                                    <option value="employee">{{ trans('sigac::visits.people.types.employee') }}</option>
                                                                    <option value="contractor">{{ trans('sigac::visits.people.types.contractor') }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <label class="form-label">{{ trans('sigac::visits.people.search') }}</label>
                                                                <input type="text" class="form-control js-staff-search" data-schedule="{{ $scheduleId }}" placeholder="{{ trans('sigac::visits.people.search_ph') }}" autocomplete="off" disabled>
                                                                <input type="hidden" name="person_in_charge_id" id="personInChargeId-{{ $scheduleId }}" disabled>
                                                                <div id="staffResults-{{ $scheduleId }}" class="list-group mt-2"></div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="notification_email" id="notification_email-{{ $scheduleId }}" disabled>

                                                        <div id="assigneeEmailsBox-{{ $scheduleId }}" class="mt-3" style="display:none;">
                                                            <label class="form-label">{{ trans('sigac::visits.people.notify_email') }}</label>
                                                            <div id="assigneeEmails-{{ $scheduleId }}" class="list-group"></div>
                                                            <small class="text-muted">{{ trans('sigac::visits.people.notify_hint') }}</small>
                                                        </div>
                                                    </div>

                                                    <div class="alert alert-info small mt-3 mb-0">
                                                        {{ trans('sigac::visits.alert.reschedule_notice') }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        {{ trans('sigac::visits.actions.close') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="bi bi-check2-circle"></i> {{ trans('sigac::visits.actions.save') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- ❌ Modal Cancelar --}}
                                <div class="modal fade" id="cancel-{{ $scheduleId }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('sigac.academic_coordination.visitschedule.cancel', $scheduleId) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ trans('sigac::visits.actions.cancel_visit') }} — {{ trans('sigac::visits.modal.request') }} #{{ $visit->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label">Quieres Cancelar la Visita?({{ trans('sigac::visits.common.optional') }})</label>
                                                    <textarea name="reason" rows="3" class="form-control" placeholder="Observacion"></textarea>
                                                    <div class="alert alert-warning mt-3 mb-0">
                                                        {!! trans('sigac::visits.alert.cancel_warn') !!}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        {{ trans('sigac::visits.actions.close') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-x-octagon-fill"></i> {{ trans('sigac::visits.actions.confirm') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endpush
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">{{ trans('sigac::visits.index.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Renderiza todos los modales aquí, FUERA de la tabla --}}
        @stack('modals')
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-icon{
        display:inline-flex;align-items:center;justify-content:center;
        width:36px;height:36px;border-radius:50%;
        transition:all .2s ease-in-out;
    }
    .btn-icon i{font-size:1.1rem;}
    .btn-icon:hover{transform:scale(1.08);box-shadow:0 4px 8px rgba(0,0,0,.15);}

    /* Si está cancelada, opacar acciones (menos “Ver”) */
    .js-actions.is-cancelled{opacity:.6;}
    .js-actions.is-cancelled .btn,.js-actions.is-cancelled a.btn{cursor:not-allowed!important;}
    .js-actions.is-cancelled .btn.btn-light{cursor:pointer!important;opacity:1;}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function(){
    // Rutas AJAX
    const SEARCH_URL = `{{ route('sigac.academic_coordination.visit.staff.search') }}`;
    const EMAILS_URL = `{{ route('sigac.academic_coordination.people.emails', ['person' => 'PERSON_ID']) }}`;

    // Tooltips
    document.querySelectorAll('[data-bs-title]').forEach(el => new bootstrap.Tooltip(el));

    // Debounce
    const debounce = (fn, d=250)=>{ let t; return (...a)=>{ clearTimeout(t); t=setTimeout(()=>fn(...a),d);} };

    // Switch "Cambiar encargado"
    document.addEventListener('change', (e)=>{
        if(!e.target.matches('.js-toggle-assign')) return;
        const sched = e.target.dataset.schedule, on = e.target.checked;
        const flag = document.getElementById(`change-assignee-${sched}`);
        const box  = document.getElementById(`assign-box-${sched}`);
        const type = document.querySelector(`.js-staff-type[data-schedule="${sched}"]`);
        const input= document.querySelector(`.js-staff-search[data-schedule="${sched}"]`);
        const pid  = document.getElementById(`personInChargeId-${sched}`);
        const mail = document.getElementById(`notification_email-${sched}`);

        if (flag) flag.value = on ? '1' : '0';
        if (box)  box.style.display = on ? 'block' : 'none';
        [type,input,pid,mail].forEach(el=>el&&(el.disabled=!on));
        if(!on){
            if(input) input.value='';
            if(pid)   pid.value='';
            if(mail)  mail.value='';
            const list = document.getElementById(`staffResults-${sched}`);
            if(list) list.innerHTML='';
            const boxE = document.getElementById(`assigneeEmailsBox-${sched}`);
            const listE= document.getElementById(`assigneeEmails-${sched}`);
            if(boxE) boxE.style.display='none';
            if(listE) listE.innerHTML='';
        }
    });

    // Buscar personas
    const doSearch = debounce((inputEl)=>{
        const sched = inputEl.dataset.schedule;
        const q = (inputEl.value||'').trim();
        const type = document.querySelector(`.js-staff-type[data-schedule="${sched}"]`)?.value || 'all';
        const list = document.getElementById(`staffResults-${sched}`);
        if(!list) return;
        if(q.length<2){ list.innerHTML=''; return; }

        fetch(`${SEARCH_URL}?q=${encodeURIComponent(q)}&type=${encodeURIComponent(type)}`)
            .then(r=>r.json())
            .then(items=>{
                list.innerHTML = items.map(it=>`
                    <button type="button"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center js-pick-person"
                        data-schedule="${sched}" data-id="${it.person_id}" data-name="${it.name}" data-type="${it.type}">
                        <span>${it.name}</span>
                        <span class="badge ${it.type==='employee'?'bg-success':'bg-warning text-dark'}">
                            ${it.type==='employee'?'{{ trans('sigac::visits.people.types.employee') }}':'{{ trans('sigac::visits.people.types.contractor') }}'}
                        </span>
                    </button>
                `).join('');
            }).catch(()=>{ list.innerHTML=''; });
    });

    document.addEventListener('input',(e)=>{
        if(e.target.matches('.js-staff-search') && !e.target.disabled) doSearch(e.target);
    });
    document.addEventListener('change',(e)=>{
        if(e.target.matches('.js-staff-type') && !e.target.disabled){
            const sched = e.target.dataset.schedule;
            const input = document.querySelector(`.js-staff-search[data-schedule="${sched}"]`);
            if(input) doSearch(input);
        }
    });

    // Elegir persona -> set hidden + correos
    document.addEventListener('click',(e)=>{
        const btn = e.target.closest('.js-pick-person'); if(!btn) return;
        const sched = btn.dataset.schedule, id = btn.dataset.id, name = btn.dataset.name;
        const label = btn.dataset.type === 'employee'
            ? '({{ trans('sigac::visits.people.types.employee') }})'
            : '({{ trans('sigac::visits.people.types.contractor') }})';
        const input = document.querySelector(`.js-staff-search[data-schedule="${sched}"]`);
        const pid   = document.getElementById(`personInChargeId-${sched}`);
        const list  = document.getElementById(`staffResults-${sched}`);
        if(pid)   pid.value = id;
        if(input) input.value = `${name} ${label}`;
        if(list)  list.innerHTML = '';
        loadEmails(sched, id);
    });

    function loadEmails(sched, personId){
        const box = document.getElementById(`assigneeEmailsBox-${sched}`);
        const list= document.getElementById(`assigneeEmails-${sched}`);
        const hid = document.getElementById(`notification_email-${sched}`);
        if(!box||!list||!hid) return;

        list.innerHTML=''; box.style.display='none'; hid.value='';
        fetch(EMAILS_URL.replace('PERSON_ID', personId))
            .then(r=>r.json())
            .then(arr=>{
                if(!Array.isArray(arr)||arr.length===0){
                    list.innerHTML = '<div class="text-muted">{{ trans('sigac::visits.people.no_emails') }}</div>';
                    box.style.display='block'; return;
                }
                list.innerHTML = arr.map((it,idx)=>`
                    <label class="list-group-item d-flex align-items-center gap-2">
                        <input type="radio" name="assignee_email_choice_${sched}" value="${it.email}" ${idx===0?'checked':''}>
                        <span class="badge bg-secondary text-uppercase">${(it.label||'').replace('_',' ')}</span>
                        <span>${it.email}</span>
                    </label>
                `).join('');
                box.style.display='block';
                const first = list.querySelector('input[type=radio]'); if(first) hid.value = first.value;
                list.querySelectorAll('input[type=radio]').forEach(r=>r.addEventListener('change',()=> hid.value=r.value));
            })
            .catch(()=>{
                list.innerHTML = '<div class="text-danger">{{ trans('sigac::visits.people.emails_error') }}</div>';
                box.style.display='block';
            });
    }

    // ===== BLOQUEO de acciones si la solicitud está Cancelada =====
    function disableActionsForRow(tr){
        const stateKey = (tr.getAttribute('data-state-key')||'').trim().toLowerCase();
        if(stateKey !== 'cancelled') return;

        const actionsBox = tr.querySelector('.js-actions'); if(!actionsBox) return;
        actionsBox.classList.add('is-cancelled');

        const visitId = tr.getAttribute('data-visit-id');
        const isViewBtn = (el) =>
            (el.matches(`button[data-bs-target="#modal${visitId}"]`) ||
             (el.matches('.btn-light') && el.querySelector('.bi-eye')));

        actionsBox.querySelectorAll('a, button, input, select, textarea').forEach(el=>{
            if (isViewBtn(el)) return; // deja “Ver”
            if (el.tagName === 'A'){
                el.classList.add('disabled'); el.style.pointerEvents='none';
                el.setAttribute('aria-disabled','true');
                el.title = '{{ trans('sigac::visits.states.blocked_by_cancel') }}';
            }
            if (el.tagName === 'BUTTON'){
                el.disabled = true;
                el.title = '{{ trans('sigac::visits.states.blocked_by_cancel') }}';
                el.removeAttribute('data-bs-toggle'); el.removeAttribute('data-bs-target');
            }
            if (['INPUT','SELECT','TEXTAREA'].includes(el.tagName)) el.disabled = true;
        });

        actionsBox.querySelectorAll('form').forEach(f=>{
            f.addEventListener('submit',(e)=>{ e.preventDefault(); e.stopPropagation(); }, {capture:true});
            f.title = '{{ trans('sigac::visits.states.blocked_by_cancel') }}';
        });
    }

    document.querySelectorAll('tbody tr[data-state-key]').forEach(disableActionsForRow);

    // Observar inyecciones dinámicas
    const tbody = document.querySelector('table tbody');
    if (tbody && 'MutationObserver' in window) {
        const mo = new MutationObserver(muts=>{
            muts.forEach(m=>m.addedNodes.forEach(n=>{
                if(n.nodeType===1 && n.matches('tr[data-state-key]')) disableActionsForRow(n);
            }));
        });
        mo.observe(tbody, { childList:true });
    }
})();
</script>
@endpush
