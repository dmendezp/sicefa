@extends('sigac::layouts.master')

@section('content')
<div class="card">
  <div class="card-header">
    <h2>{{ trans('sigac::visits.title.schedule') }} ({{ trans('sigac::visits.modal.request') }} #{{ $request->id }})</h2>
  </div>

  <div class="card-body">
    {!! Form::open([
        'route' => 'sigac.academic_coordination.visitschedule.store',
        'method' => 'POST',
        'id' => 'visit-form',
    ]) !!}
    @csrf

    {{-- ID de la solicitud --}}
    {!! Form::hidden('visit_request_id', $request->id) !!}

    <div class="row">
      {{-- Encargado (buscador unificado) --}}
      <div class="mb-3">
        <label class="form-label">{{ trans('sigac::visits.schedule.in_charge') }}</label>
        <div class="row g-2">
          <div class="col-md-3">
            <select id="staffType" class="form-select">
              <option value="all">{{ trans('sigac::visits.schedule.type.all') }}</option>
              <option value="employee">{{ trans('sigac::visits.schedule.type.employee') }}</option>
              <option value="contractor">{{ trans('sigac::visits.schedule.type.contractor') }}</option>
            </select>
          </div>
          <div class="col-md-9">
            <input
              type="text"
              id="staffSearch"
              class="form-control"
              placeholder="{{ trans('sigac::visits.schedule.search_placeholder') }}"
              autocomplete="off">
            <input type="hidden" name="person_in_charge_id" id="personInChargeId">
            <div id="staffResults" class="list-group mt-2"></div>
          </div>
        </div>
        <div class="form-text">{{ trans('sigac::visits.schedule.search_hint') }}</div>
      </div>

      {{-- correo elegido para notificación --}}
      <input type="hidden" name="notification_email" id="notification_email">

      {{-- Correos del encargado (visibles al elegir) --}}
      <div id="assigneeEmailsBox" class="mt-2" style="display:none;">
        <label class="form-label">{{ trans('sigac::visits.schedule.email_label') }}</label>
        <div id="assigneeEmails" class="list-group"></div>
        <small class="text-muted">{{ trans('sigac::visits.schedule.email_hint') }}</small>
      </div>

      <div class="col-6 mb-3">
        {!! Form::label('activity', trans('sigac::visits.schedule.activity')) !!}
        {!! Form::text('activity', null, [
            'class' => 'form-control',
            'list' => 'activities',
            'required',
            'id' => 'activity',
        ]) !!}
        <datalist id="activities">
          @foreach ($activities as $activity)
            <option value="{{ $activity }}"></option>
          @endforeach
        </datalist>
      </div>
    </div>

    <div class="row">
      <div class="col-4 mb-3">
        {!! Form::label('date', trans('sigac::visits.schedule.day')) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'date', 'required']) !!}
      </div>
      <div class="col-4 mb-3">
        {!! Form::label('start_time', trans('sigac::visits.schedule.start_time')) !!}
        {!! Form::time('start_time', null, ['class' => 'form-control', 'id' => 'start_time', 'required']) !!}
      </div>
      <div class="col-4 mb-3">
        {!! Form::label('end_time', trans('sigac::visits.schedule.end_time')) !!}
        {!! Form::time('end_time', null, ['class' => 'form-control', 'id' => 'end_time', 'required']) !!}
      </div>
    </div>

    {{-- Ambiente (opcional) --}}
    <div class="form-group mb-2">
      {!! Form::label('environment_id', trans('sigac::visits.schedule.environment_label')) !!}
      {!! Form::select('environment_id', [], null, [
          'class' => 'form-control',
          'id' => 'environment_id',
          'placeholder' => trans('sigac::visits.schedule.environment_placeholder'),
          'disabled' => true,
      ]) !!}
      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" id="no_env" checked>
        <label class="form-check-label" for="no_env">{{ trans('sigac::visits.schedule.no_environment_label') }}</label>
      </div>
      <small id="env-helper" class="form-text text-muted"></small>
    </div>

    <div class="mb-3">
      {!! Form::label('observations', trans('sigac::visits.schedule.observations')) !!}
      {!! Form::textarea('observations', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>

    <div class="d-flex justify-content-end">
      <button id="submitBtn" type="submit" class="btn btn-primary" disabled>
        {{ trans('sigac::visits.schedule.button.submit') }}
      </button>
    </div>

    {!! Form::close() !!}
  </div>
</div>

<script>
/* ========== Mensajes traducidos para JS (no hardcodear textos) ========== */
const MSG = {
  no_emails: @json(trans('sigac::visits.people.no_emails')),
  emails_error: @json(trans('sigac::visits.people.emails_error')),
  assign_later: @json(trans('sigac::visits.common.assign_later')),
  env_assign_later_hint: @json(trans('sigac::visits.schedule.env_assign_later_hint')),
  env_select_prompt: @json(trans('sigac::visits.schedule.env_select_prompt')),
  env_loading: @json(trans('sigac::visits.schedule.env_loading')),
  env_range_invalid: @json(trans('sigac::visits.schedule.env_range_invalid')),
  env_none_available: @json(trans('sigac::visits.schedule.env_none_available')),
  env_loaded_ok: @json(trans('sigac::visits.schedule.env_loaded_ok')),
  env_loaded_empty: @json(trans('sigac::visits.schedule.env_loaded_empty')),
};

/* ===================== Buscador Encargado + Correos ===================== */
(function() {
  const search   = document.getElementById('staffSearch');
  const typeSel  = document.getElementById('staffType');
  const results  = document.getElementById('staffResults');
  const hiddenId = document.getElementById('personInChargeId');

  const emailsBox   = document.getElementById('assigneeEmailsBox');
  const emailsDiv   = document.getElementById('assigneeEmails');
  const emailHidden = document.getElementById('notification_email');

  let timer;

  function doSearch() {
    const q = search.value.trim();
    const type = typeSel.value;
    if (q.length < 2) { results.innerHTML = ''; return; }

    fetch(`{{ route('sigac.academic_coordination.visit.staff.search') }}?q=${encodeURIComponent(q)}&type=${encodeURIComponent(type)}`)
      .then(r => r.json())
      .then(items => {
        results.innerHTML = items.map(it => `
          <button type="button"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                  data-id="${it.person_id}" data-name="${it.name}" data-type="${it.type}">
            <span>${it.name}</span>
            <span class="badge ${it.type==='employee'?'bg-success':'bg-warning text-dark'}">
              ${it.type==='employee' ? @json(trans('sigac::visits.people.types.employee')) : @json(trans('sigac::visits.people.types.contractor'))}
            </span>
          </button>
        `).join('');
      })
      .catch(() => { results.innerHTML = ''; });
  }

  search.addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(doSearch, 250); });
  typeSel.addEventListener('change', doSearch);

  // selección de persona + carga de correos
  results.addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-id]');
    if (!btn) return;

    hiddenId.value = btn.dataset.id;
    const label = btn.dataset.type === 'employee'
      ? @json('(' . trans('sigac::visits.people.types.employee') . ')')
      : @json('(' . trans('sigac::visits.people.types.contractor') . ')');
    search.value = `${btn.dataset.name} ${label}`;
    results.innerHTML = '';

    loadPersonEmails(hiddenId.value);
    validateReady();
  });

  function loadPersonEmails(personId) {
    emailsDiv.innerHTML = '';
    emailsBox.style.display = 'none';
    emailHidden.value = '';

    fetch(`{{ route('sigac.academic_coordination.people.emails', ['person' => 'PERSON_ID']) }}`.replace('PERSON_ID', personId))
      .then(r => r.json())
      .then(list => {
        if (!Array.isArray(list) || list.length === 0) {
          emailsDiv.innerHTML = `<div class="text-muted">${MSG.no_emails}</div>`;
          emailsBox.style.display = 'block';
          return;
        }

        emailsDiv.innerHTML = list.map((it, idx) => `
          <label class="list-group-item d-flex align-items-center gap-2">
            <input type="radio" name="assignee_email_choice" value="${it.email}" ${idx===0 ? 'checked' : ''}>
            <span class="badge bg-secondary text-uppercase">${(it.label || '').replace('_',' ')}</span>
            <span>${it.email}</span>
          </label>
        `).join('');

        emailsBox.style.display = 'block';

        // por defecto, el primero
        const first = emailsDiv.querySelector('input[type=radio]');
        if (first) emailHidden.value = first.value;

        emailsDiv.querySelectorAll('input[type=radio]').forEach(r => {
          r.addEventListener('change', () => { emailHidden.value = r.value; });
        });
      })
      .catch(() => {
        emailsDiv.innerHTML = `<div class="text-danger">${MSG.emails_error}</div>`;
        emailsBox.style.display = 'block';
      });
  }
})();

/* ============ Ambientes (opcional) + Validación de envío ============ */
(function() {
  const activity  = document.getElementById('activity');
  const date      = document.getElementById('date');
  const startTime = document.getElementById('start_time');
  const endTime   = document.getElementById('end_time');
  const envSelect = document.getElementById('environment_id');
  const noEnvCB   = document.getElementById('no_env');
  const submitBtn = document.getElementById('submitBtn');
  const helper    = document.getElementById('env-helper');
  const form      = document.getElementById('visit-form');
  const personId  = document.getElementById('personInChargeId');

  // CSRF para fetch
  let token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  if (!token) {
    const hidden = document.querySelector('input[name="_token"]');
    if (hidden) token = hidden.value;
  }
  const url = "{{ route('sigac.academic_coordination.visit.environments.search') }}";

  window.validateReady = function() {
    const baseOk = activity.value.trim()
      && date.value && startTime.value && endTime.value
      && (startTime.value < endTime.value)
      && personId.value; // Debe haber encargado
    const envOk = noEnvCB.checked ? true : (envSelect.value !== undefined);

    submitBtn.disabled = !(baseOk && envOk);
  };

  function toggleEnvDisabled() {
    if (noEnvCB.checked) {
      envSelect.value = '';
      envSelect.setAttribute('disabled', 'disabled');
      helper.textContent = MSG.env_assign_later_hint;
    } else {
      envSelect.removeAttribute('disabled');
      helper.textContent = MSG.env_select_prompt;
      if (date.value && startTime.value && endTime.value && startTime.value < endTime.value) {
        fetchEnvironments();
      }
    }
    validateReady();
  }

  function setEmpty(msg) {
    envSelect.innerHTML = '';
    const optNone = document.createElement('option');
    optNone.value = '';
    optNone.textContent = MSG.assign_later;
    envSelect.appendChild(optNone);
    if (!noEnvCB.checked) envSelect.disabled = false;
    helper.textContent = (msg || MSG.env_none_available) + ' ' + MSG.env_assign_later_hint;
    validateReady();
  }

  async function fetchEnvironments() {
    if (noEnvCB.checked) { validateReady(); return; }

    const d = date.value, s = startTime.value, e = endTime.value;
    if (!d || !s || !e) { setEmpty(MSG.env_select_prompt); return; }
    if (s >= e)         { setEmpty(MSG.env_range_invalid); return; }

    envSelect.innerHTML = '';
    envSelect.disabled  = true;
    helper.textContent  = MSG.env_loading;

    try {
      const res = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
        body: JSON.stringify({ date: d, start_time: s, end_time: e })
      });
      if (!res.ok) throw new Error('HTTP ' + res.status);

      const data = await res.json(); // [{id,name}]
      envSelect.innerHTML = '';

      const optNone = document.createElement('option');
      optNone.value = '';
      optNone.textContent = MSG.assign_later;
      envSelect.appendChild(optNone);

      if (Array.isArray(data) && data.length) {
        data.forEach(env => {
          const opt = document.createElement('option');
          opt.value = env.id; opt.textContent = env.name;
          envSelect.appendChild(opt);
        });
        envSelect.disabled = false;
        helper.textContent = MSG.env_loaded_ok;
      } else {
        envSelect.disabled = false;
        helper.textContent = MSG.env_loaded_empty;
      }
    } catch (err) {
      console.error(err);
      setEmpty(MSG.env_loaded_empty);
    } finally {
      validateReady();
    }
  }

  [activity, date, startTime, endTime].forEach(el => el.addEventListener('change', () => {
    fetchEnvironments();
    validateReady();
  }));
  envSelect.addEventListener('change', validateReady);
  noEnvCB.addEventListener('change', toggleEnvDisabled);

  form.addEventListener('submit', (e) => { if (submitBtn.disabled) e.preventDefault(); });

  // Estado inicial
  toggleEnvDisabled();
  validateReady();
})();
</script>
@endsection
