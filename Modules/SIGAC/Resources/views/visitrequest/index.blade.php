@extends('sigac::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Solicitudes de visita</h2>
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
                    <strong>Revisa los datos:</strong>
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
                            <th>Empresa</th>
                            <th>NIT</th>
                            <th>Solicitante</th>
                            <th>Fecha de recepción</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Nº personas</th>
                            <th style="width: 350px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitRequests as $visit)
                            @php
                                $hasEmail = filled($visit->contact_email);
                                $lastSchedule = optional($visit->schedules)->last();
                                $scheduleId = $lastSchedule->id ?? null;

                                $excelPathRaw = (string) ($visit->people_list_path ?? '');
                                $excelPath = str_replace('\\', '/', $excelPathRaw);
                                if (
                                    \Illuminate\Support\Str::startsWith($excelPath, ['storage/app/', '/storage/app/'])
                                ) {
                                    $excelPath = \Illuminate\Support\Str::after($excelPath, 'storage/app/');
                                }
                                $canViewExcel =
                                    $excelPath &&
                                    \Illuminate\Support\Facades\Storage::disk('local')->exists($excelPath);
                            @endphp

                            <tr>
                                <td>{{ $visit->id }}</td>
                                <td>{{ $visit->company->name }}</td>
                                <td>{{ $visit->company->nit ?? '—' }}</td>
                                <td>{{ $visit->person->full_name ?? '—' }}</td>
                                <td>{{ $visit->date_received }}</td>
                                <td class="text-capitalize">{{ $visit->type }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $visit->state === 'Agendada' ? 'success' : ($visit->state === 'Cancelada' ? 'danger' : 'secondary') }}">
                                        {{ $visit->state }}
                                    </span>
                                </td>
                                <td>{{ $visit->number_of_people ?? '—' }}</td>

                                <td class="d-flex flex-wrap gap-2 align-items-center">
                                    {{-- 👁️ Ver (icono) --}}
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $visit->id }}" title="Ver detalle">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>

                                    {{-- 🗓️ Agendar (icono) o acciones --}}
                                    @if ($visit->state === 'Sin agendar')
                                        <a href="{{ route('sigac.academic_coordination.visitschedule.create', ['request' => $visit->id]) }}"
                                            class="btn btn-sm btn-outline-primary" title="Agendar">
                                            <i class="bi bi-calendar-plus-fill"></i>
                                        </a>
                                    @else
                                        {{-- ✉️ Notificar (icono) --}}
                                        @if (Route::has('sigac.academic_coordination.visitrequest.notify'))
                                            @if ($hasEmail)
                                                <form
                                                    action="{{ route('sigac.academic_coordination.visitrequest.notify', $visit->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('¿Enviar notificación a {{ $visit->contact_email }}?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                                        title="Notificar">
                                                        <i class="bi bi-envelope-paper-heart-fill"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form
                                                    action="{{ route('sigac.academic_coordination.visitrequest.notify', $visit->id) }}"
                                                    method="POST" class="d-inline d-flex align-items-center gap-2"
                                                    onsubmit="
                                                    const v = this.querySelector('input[name=override_email]').value.trim();
                                                    if(!v){ alert('Por favor ingresa un correo válido.'); return false; }
                                                    return confirm('Se enviará la notificación a ' + v + '. ¿Continuar?');
                                                  ">
                                                    @csrf
                                                    <input type="email" name="override_email"
                                                        class="form-control form-control-sm"
                                                        placeholder="correo@empresa.com" required style="max-width: 200px;">
                                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                                        title="Enviar correo">
                                                        <i class="bi bi-send-fill"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                        {{-- 🔄 Reprogramar (abre modal) --}}
                                        @if ($scheduleId)
                                            <button type="button" class="btn btn-sm btn-outline-warning"
                                                data-bs-toggle="modal" data-bs-target="#reprogram-{{ $scheduleId }}"
                                                title="Reprogramar">
                                                <i class="bi bi-calendar2-event-fill"></i>
                                            </button>
                                        @endif

                                        {{-- ❌ Cancelar (abre modal) --}}
                                        @if ($scheduleId)
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#cancel-{{ $scheduleId }}"
                                                title="Cancelar visita">
                                                <i class="bi bi-x-octagon-fill"></i>
                                            </button>
                                        @endif
                                    @endif

                                    {{-- 📎 Excel (icono) --}}
                                    @if ($canViewExcel)
                                        <a href="{{ \Illuminate\Support\Facades\URL::temporarySignedRoute('sigac.visits.peoplelist.view', now()->addDays(7), [
                                            'visit' => $visit->id,
                                        ]) }}"
                                            class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener"
                                            title="Ver listado Excel">
                                            <i class="bi bi-file-earmark-excel-fill"></i>
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-outline-secondary" disabled title="Sin archivo">
                                            <i class="bi bi-file-earmark-x-fill"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            {{-- 📄 Modal detalle --}}
                            <div class="modal fade" id="modal{{ $visit->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Solicitud #{{ $visit->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-4">Empresa</dt>
                                                <dd class="col-sm-8">{{ $visit->company->name }}</dd>

                                                <dt class="col-sm-4">Contacto</dt>
                                                <dd class="col-sm-8">{{ $visit->contact_name ?? '—' }}</dd>

                                                <dt class="col-sm-4">Correo</dt>
                                                <dd class="col-sm-8">{{ $visit->contact_email ?? '—' }}</dd>

                                                <dt class="col-sm-4">Teléfono</dt>
                                                <dd class="col-sm-8">{{ $visit->contact_phone ?? '—' }}</dd>

                                                <dt class="col-sm-4">Tipo</dt>
                                                <dd class="col-sm-8 text-capitalize">{{ $visit->type }}</dd>

                                                @if ($visit->type === 'practica')
                                                    <dt class="col-sm-4">Requerimientos</dt>
                                                    <dd class="col-sm-8">{{ $visit->practice_requirements ?? '—' }}</dd>
                                                @endif

                                                <dt class="col-sm-4">Observaciones</dt>
                                                <dd class="col-sm-8">{{ $visit->observations ?? '—' }}</dd>
                                            </dl>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($scheduleId)
                                @php $sch = $lastSchedule; @endphp
                                <div class="modal fade" id="reprogram-{{ $scheduleId }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="POST"
                                                action="{{ route('sigac.academic_coordination.visitschedule.update', $scheduleId) }}">
                                                @csrf {{-- IMPORTANTE: sin @method('PUT') si tu ruta acepta POST --}}
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Reprogramar visita — Solicitud #{{ $visit->id }}
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    {{-- Fecha y horas --}}
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-12 col-md-4">
                                                            <label class="form-label">Día</label>
                                                            <input type="date" name="date" class="form-control"
                                                                value="{{ $sch->date }}" required>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <label class="form-label">Inicio</label>
                                                            <input type="time" name="start_time" class="form-control"
                                                                value="{{ $sch->start_time }}" required>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <label class="form-label">Fin</label>
                                                            <input type="time" name="end_time" class="form-control"
                                                                value="{{ $sch->end_time }}" required>
                                                        </div>
                                                    </div>

                                                    {{-- Actividad / Ambiente (opcional) --}}
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Actividad (opcional)</label>
                                                            <input type="text" name="activity" class="form-control"
                                                                value="{{ $sch->activity }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Ambiente (opcional)</label>
                                                            <select name="environment_id" class="form-select">
                                                                <option value="">(Asignar después)</option>
                                                                @foreach ($environments ?? [] as $envId => $envName)
                                                                    <option value="{{ $envId }}"
                                                                        @selected($sch->environment_id == $envId)>{{ $envName }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Observaciones (opcional)</label>
                                                        <textarea name="observations" rows="2" class="form-control">{{ $sch->observations }}</textarea>
                                                    </div>

                                                    {{-- 🔁 Cambiar encargado (opcional) --}}
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input js-toggle-assign" type="checkbox"
                                                            id="toggle-assign-{{ $scheduleId }}"
                                                            data-schedule="{{ $scheduleId }}">
                                                        <label class="form-check-label"
                                                            for="toggle-assign-{{ $scheduleId }}">
                                                            Cambiar encargado
                                                        </label>
                                                    </div>

                                                    {{-- Indicador para el backend --}}
                                                    <input type="hidden" name="change_assignee"
                                                        id="change-assignee-{{ $scheduleId }}" value="0">

                                                    {{-- Bloque buscador de encargado (oculto y deshabilitado por defecto) --}}
                                                    <div id="assign-box-{{ $scheduleId }}" class="border rounded p-3"
                                                        style="display:none;">
                                                        <div class="row g-2 align-items-end">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Tipo</label>
                                                                <select class="form-select js-staff-type"
                                                                    data-schedule="{{ $scheduleId }}" disabled>
                                                                    <option value="all">Todos</option>
                                                                    <option value="employee">Planta</option>
                                                                    <option value="contractor">Contratista</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <label class="form-label">Buscar persona</label>
                                                                <input type="text" class="form-control js-staff-search"
                                                                    data-schedule="{{ $scheduleId }}"
                                                                    placeholder="Nombre o apellido..." autocomplete="off"
                                                                    disabled>
                                                                <input type="hidden" name="person_in_charge_id"
                                                                    id="personInChargeId-{{ $scheduleId }}" disabled>
                                                                <div id="staffResults-{{ $scheduleId }}"
                                                                    class="list-group mt-2"></div>
                                                            </div>
                                                        </div>

                                                        {{-- Correos del encargado nuevo --}}
                                                        <input type="hidden" name="notification_email"
                                                            id="notification_email-{{ $scheduleId }}" disabled>

                                                        <div id="assigneeEmailsBox-{{ $scheduleId }}" class="mt-3"
                                                            style="display:none;">
                                                            <label class="form-label">Correo para notificaciones</label>
                                                            <div id="assigneeEmails-{{ $scheduleId }}"
                                                                class="list-group"></div>
                                                            <small class="text-muted">Selecciona a qué correo se enviarán
                                                                las notificaciones.</small>
                                                        </div>
                                                    </div>

                                                    <div class="alert alert-info small mt-3 mb-0">
                                                        Se notificará automáticamente al contacto, al encargado nuevo y al
                                                        anterior si cambias el encargado,
                                                        y a las partes en caso de reprogramación o cancelación.
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="bi bi-check2-circle"></i> Guardar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- ❌ Modal Cancelar (con motivo) --}}
                                <div class="modal fade" id="cancel-{{ $scheduleId }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="POST"
                                                action="{{ route('sigac.academic_coordination.visitschedule.cancel', $scheduleId) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Cancelar visita — Solicitud #{{ $visit->id }}
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label">Motivo (opcional)</label>
                                                    <textarea name="reason" rows="3" class="form-control" placeholder="Escribe el motivo..."></textarea>
                                                    <div class="alert alert-warning mt-3 mb-0">
                                                        Esta acción marcará la solicitud como <strong>Cancelada</strong> y
                                                        notificará a las partes.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-x-octagon-fill"></i> Confirmar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No hay solicitudes registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function(){
  // Rutas para AJAX
  const SEARCH_URL = `{{ route('sigac.academic_coordination.visit.staff.search') }}`;
  const EMAILS_URL = `{{ route('sigac.academic_coordination.people.emails', ['person' => 'PERSON_ID']) }}`;

  // Debounce genérico
  const debounce = (fn, delay=250) => { let t; return (...a)=>{ clearTimeout(t); t=setTimeout(()=>fn(...a), delay); }; };

  // 1) Encender/apagar bloque de cambio de encargado
  document.addEventListener('change', (e)=>{
    if (!e.target.matches('.js-toggle-assign')) return;
    const sched = e.target.dataset.schedule;
    const on = e.target.checked;

    // hidden para backend
    const flag = document.getElementById(`change-assignee-${sched}`);
    if (flag) flag.value = on ? '1' : '0';

    const box   = document.getElementById(`assign-box-${sched}`);
    const type  = document.querySelector(`.js-staff-type[data-schedule="${sched}"]`);
    const input = document.querySelector(`.js-staff-search[data-schedule="${sched}"]`);
    const pid   = document.getElementById(`personInChargeId-${sched}`);
    const mail  = document.getElementById(`notification_email-${sched}`);

    if (box)  box.style.display = on ? 'block' : 'none';
    [type, input, pid, mail].forEach(el => { if (el) el.disabled = !on; });

    if (!on) {
      // Limpia selección si apagan el switch
      if (input) input.value = '';
      if (pid)   pid.value = '';
      if (mail)  mail.value = '';
      const list = document.getElementById(`staffResults-${sched}`);
      if (list) list.innerHTML = '';
      const boxEmails = document.getElementById(`assigneeEmailsBox-${sched}`);
      const listEmails = document.getElementById(`assigneeEmails-${sched}`);
      if (boxEmails) boxEmails.style.display = 'none';
      if (listEmails) listEmails.innerHTML = '';
    }
  });

  // 2) Búsqueda de personas
  const doSearch = debounce((inputEl)=>{
    const sched = inputEl.dataset.schedule;
    const q     = (inputEl.value||'').trim();
    const type  = document.querySelector(`.js-staff-type[data-schedule="${sched}"]`)?.value || 'all';
    const list  = document.getElementById(`staffResults-${sched}`);
    if (!list) return;
    if (q.length < 2) { list.innerHTML = ''; return; }

    fetch(`${SEARCH_URL}?q=${encodeURIComponent(q)}&type=${encodeURIComponent(type)}`)
      .then(r=>r.json())
      .then(items=>{
        list.innerHTML = items.map(it=>`
          <button type="button"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center js-pick-person"
                  data-schedule="${sched}" data-id="${it.person_id}" data-name="${it.name}" data-type="${it.type}">
            <span>${it.name}</span>
            <span class="badge ${it.type==='employee'?'bg-success':'bg-warning text-dark'}">
              ${it.type==='employee'?'Planta':'Contratista'}
            </span>
          </button>`).join('');
      }).catch(()=>{ list.innerHTML=''; });
  });

  document.addEventListener('input', (e)=>{
    if (e.target.matches('.js-staff-search') && !e.target.disabled) doSearch(e.target);
  });
  document.addEventListener('change', (e)=>{
    if (e.target.matches('.js-staff-type') && !e.target.disabled) {
      const sched = e.target.dataset.schedule;
      const input = document.querySelector(`.js-staff-search[data-schedule="${sched}"]`);
      if (input) doSearch(input);
    }
  });

  // 3) Elegir persona → set hidden + cargar correos
  document.addEventListener('click', (e)=>{
    const btn = e.target.closest('.js-pick-person'); if (!btn) return;
    const sched = btn.dataset.schedule;
    const id    = btn.dataset.id;
    const name  = btn.dataset.name;
    const label = btn.dataset.type==='employee' ? '(Planta)' : '(Contratista)';

    const input = document.querySelector(`.js-staff-search[data-schedule="${sched}"]`);
    const pid   = document.getElementById(`personInChargeId-${sched}`);
    const list  = document.getElementById(`staffResults-${sched}`);

    if (pid)   pid.value = id;
    if (input) input.value = `${name} ${label}`;
    if (list)  list.innerHTML = '';

    loadEmails(sched, id);
  });

  function loadEmails(sched, personId){
    const box  = document.getElementById(`assigneeEmailsBox-${sched}`);
    const list = document.getElementById(`assigneeEmails-${sched}`);
    const hid  = document.getElementById(`notification_email-${sched}`);
    if (!box || !list || !hid) return;

    list.innerHTML=''; box.style.display='none'; hid.value='';

    fetch(EMAILS_URL.replace('PERSON_ID', personId))
      .then(r=>r.json())
      .then(arr=>{
        if (!Array.isArray(arr) || arr.length===0) {
          list.innerHTML = '<div class="text-muted">Esta persona no tiene correos registrados.</div>';
          box.style.display='block';
          return;
        }
        list.innerHTML = arr.map((it,idx)=>`
          <label class="list-group-item d-flex align-items-center gap-2">
            <input type="radio" name="assignee_email_choice_${sched}" value="${it.email}" ${idx===0?'checked':''}>
            <span class="badge bg-secondary text-uppercase">${it.label.replace('_',' ')}</span>
            <span>${it.email}</span>
          </label>`).join('');
        box.style.display='block';
        const first = list.querySelector('input[type=radio]');
        if (first) hid.value = first.value;
        list.querySelectorAll('input[type=radio]').forEach(r=>{
          r.addEventListener('change', ()=> hid.value = r.value);
        });
      })
      .catch(()=>{
        list.innerHTML = '<div class="text-danger">No se pudieron cargar los correos.</div>';
        box.style.display='block';
      });
  }

  // 4) Al abrir el modal, deja el switch apagado y todo deshabilitado
  document.addEventListener('shown.bs.modal', (e)=>{
    const id = e.target.id || '';
    if (!id.startsWith('reprogram-')) return;
    const sched = id.replace('reprogram-','');

    const toggle = document.getElementById(`toggle-assign-${sched}`);
    if (toggle) {
      toggle.checked = false;
      toggle.dispatchEvent(new Event('change')); // fuerza estado inicial off
    }
  });
})();
</script>
@endpush
