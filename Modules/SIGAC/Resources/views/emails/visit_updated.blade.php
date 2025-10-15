<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Notificación de visita</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;margin:0;background:#f6f7f9;color:#111}
    .wrap{max-width:640px;margin:0 auto;padding:24px}
    .card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden}
    .card h2{margin:0;padding:16px 20px;background:#0ea5e9;color:#fff;font-size:18px}
    .section{padding:16px 20px}
    .muted{color:#6b7280}
    ul{margin:8px 0 0 18px}
    .badge{display:inline-block;padding:2px 8px;border-radius:999px;font-size:12px}
    .warn{background:#fef3c7;color:#92400e}
    .ok{background:#dcfce7;color:#14532d}
    .danger{background:#fee2e2;color:#991b1b}
    .btn{display:inline-block;margin-top:12px;padding:8px 12px;background:#111;color:#fff;text-decoration:none;border-radius:8px}
  </style>
</head>
<body>
  @php
    $isCanceled = ($event ?? '') === 'canceled';
    $title = $isCanceled ? 'La visita fue cancelada' :
             (($event ?? '') === 'rescheduled' ? 'La visita fue reprogramada' : 'La visita fue actualizada');
  @endphp
  <div class="wrap">
    <div class="card">
      <h2>{{ $title }}</h2>
      <div class="section">
        <p>
          Solicitud <strong>#{{ $visitRequest->id }}</strong>
          @if($visitRequest->company)
            — Empresa: <strong>{{ $visitRequest->company->name }}</strong>
          @endif
        </p>

        <p class="muted">Resumen actual</p>
        <ul>
          <li><strong>Actividad:</strong> {{ $visitSchedule->activity }}</li>
          <li><strong>Fecha / Hora:</strong> {{ $visitSchedule->date }} | {{ $visitSchedule->start_time }}–{{ $visitSchedule->end_time }}</li>
          @if($visitSchedule->environment)
            <li><strong>Ambiente:</strong> {{ $visitSchedule->environment->name }}</li>
          @endif
          @if($visitSchedule->personInCharge)
            <li><strong>Encargado:</strong>
              {{ $visitSchedule->personInCharge->first_name }} {{ $visitSchedule->personInCharge->first_last_name }}
            </li>
          @endif
        </ul>

        @if(!empty($summaryLines))
          <p class="muted" style="margin-top:16px;">Cambios</p>
          <ul>
            @foreach($summaryLines as $line)
              <li>{!! $line !!}</li>
            @endforeach
          </ul>
        @elseif(!empty($changes))
          <p class="muted" style="margin-top:16px;">Cambios</p>
          <ul>
            @foreach($changes as $key => $chg)
              @continue($key === '_schedule_changed')
              <li>
                <strong>{{ ucfirst(str_replace('_',' ', $key)) }}:</strong>
                @if(is_array($chg) && (isset($chg['before']) || isset($chg['after'])))
                  <div>Antes: {{ $chg['before'] ?? '—' }}</div>
                  <div>Ahora: {{ $chg['after'] ?? '—' }}</div>
                @else
                  {{ is_array($chg) ? json_encode($chg) : (string)$chg }}
                @endif
              </li>
            @endforeach
          </ul>
        @endif

        @if($isCanceled)
          <p style="margin-top:16px">
            <span class="badge danger">Cancelada</span>
            @if(!empty($visitSchedule->observations))
              &nbsp;Motivo/nota: {{ $visitSchedule->observations }}
            @endif
          </p>
        @endif

        <p style="margin-top:20px" class="muted">
          Este mensaje fue generado automáticamente por SICEFA / SIGAC.
        </p>
      </div>
    </div>
  </div>
</body>
</html>
