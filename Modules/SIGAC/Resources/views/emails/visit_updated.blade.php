<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Actualización de visita</title>
</head>
<body>
  @php
    $isCanceled = !empty($event) && $event === 'canceled';
    $title = $isCanceled ? 'La visita fue cancelada' : 'La visita fue actualizada';
  @endphp

  <h2>{{ $title }}</h2>

  <p>
    Solicitud <strong>#{{ $visitRequest->id }}</strong>
    @if($visitRequest->company)
      — Empresa: <strong>{{ $visitRequest->company->name }}</strong>
    @endif
  </p>

  <ul>
    <li><strong>Actividad:</strong> {{ $visitSchedule->activity }}</li>
    <li><strong>Fecha / Hora:</strong> {{ $visitSchedule->date }} | {{ $visitSchedule->start_time }}–{{ $visitSchedule->end_time }}</li>
    @if($visitSchedule->environment)
      <li><strong>Ambiente:</strong> {{ $visitSchedule->environment->name }}</li>
    @endif
    @if($visitSchedule->personInCharge)
      <li><strong>Encargado:</strong> {{ $visitSchedule->personInCharge->first_name }} {{ $visitSchedule->personInCharge->first_last_name }}</li>
    @endif
  </ul>

  @if(!empty($changes))
    <h3>Cambios</h3>
    <ul>
      @foreach($changes as $key => $chg)
        <li>
          <strong>{{ ucfirst(str_replace('_',' ', $key)) }}:</strong>
          @if(is_array($chg))
            @if(isset($chg['before']) || isset($chg['after']))
              <div>Antes: {{ $chg['before'] ?? '—' }}</div>
              <div>Ahora: {{ $chg['after'] ?? '—' }}</div>
            @else
              {{ json_encode($chg) }}
            @endif
          @else
            {{ (string)$chg }}
          @endif
        </li>
      @endforeach
    </ul>
  @endif

  @if($isCanceled)
    <p><em>Motivo de cancelación (si aplica):</em> {{ $visitSchedule->observations ?? '—' }}</p>
  @endif

  <p>Saludos,<br><strong>Equipo SIGAC / SICEFA</strong></p>
</body>
</html>
