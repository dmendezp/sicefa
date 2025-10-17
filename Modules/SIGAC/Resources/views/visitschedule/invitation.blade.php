@extends('sigac::layouts.master')

@section('content')
<div class="container my-4">
  <div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="m-0">📄 Detalle de la visita</h4>
      @if($schedule->date)
        <small class="text-muted">Válido hasta {{ \Illuminate\Support\Carbon::parse($schedule->date)->format('d/m/Y') }}</small>
      @endif
    </div>

    <div class="card-body">
      <h5 class="mb-3">Solicitud</h5>
      <div class="row mb-3">
        <div class="col-md-6">
          <div><strong>Empresa:</strong> {{ optional($visit->company)->name ?? '—' }}</div>
          <div><strong>NIT:</strong> {{ optional($visit->company)->nit ?? '—' }}</div>
          <div><strong>Solicitante:</strong> {{ $visit->contact_name ?? '—' }}</div>
          <div><strong>Correo:</strong> {{ $visit->contact_email ?? '—' }}</div>
          <div><strong>Teléfono:</strong> {{ $visit->contact_phone ?? '—' }}</div>
        </div>
        <div class="col-md-6">
          <div><strong>Fecha de recepción:</strong> {{ $visit->date_received ? \Illuminate\Support\Carbon::parse($visit->date_received)->format('d/m/Y') : '—' }}</div>
          <div><strong>Estado de la solicitud:</strong> {{ $visit->state ?? '—' }}</div>
          <div><strong>Descripción:</strong> {{ $visit->description ?? '—' }}</div>
        </div>
      </div>

      <hr>

      <h5 class="mb-3">Agenda</h5>
      <div class="row">
        <div class="col-md-6">
          <div><strong>Actividad:</strong> {{ $schedule->activity ?? '—' }}</div>
          <div><strong>Fecha:</strong> {{ $schedule->date ? \Illuminate\Support\Carbon::parse($schedule->date)->format('d/m/Y') : '—' }}</div>
          <div><strong>Horario:</strong> {{ $schedule->start_time ?? '—' }} - {{ $schedule->end_time ?? '—' }}</div>
          <div><strong>Estado:</strong>
            @php
              $state = $visit->state ?? '—';
              $badge = $state === 'Cancelada' ? 'bg-danger'
                     : ($state === 'Agendada' ? 'bg-primary' : 'bg-secondary');
            @endphp
            <span class="badge {{ $badge }}">{{ $state }}</span>
          </div>
        </div>
        <div class="col-md-6">
          <div><strong>Ambiente:</strong> {{ optional($schedule->environment)->name ?? '—' }}</div>
          <div><strong>Encargado:</strong>
            @if($schedule->personInCharge)
              {{ trim($schedule->personInCharge->first_name.' '.$schedule->personInCharge->first_last_name.' '.($schedule->personInCharge->second_last_name ?? '')) }}
            @else
              —
            @endif
          </div>
          <div><strong>Correo notificación:</strong> {{ $schedule->notification_email ?? '—' }}</div>
          <div><strong>Observaciones:</strong> {{ $schedule->observations ?? '—' }}</div>
        </div>
      </div>

      <div class="mt-4 text-center">
        <a href="{{ route('sigac.academic_coordination.dashboard') }}" class="btn btn-outline-secondary">
          Ir al sitio SICEFA
        </a>
      </div>
    </div>

    <div class="card-footer text-center text-muted">
      SENA - SICEFA · Esta ficha es informativa y no requiere autenticación.
    </div>
  </div>
</div>
@endsection
