<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Visita Agendada</title>
</head>

<body>
    <h2>📅 Visita agendada correctamente</h2>

    <p>Estimado/a {{ $visitSchedule->personInCharge->full_name ?? 'Encargado' }},</p>

    <p>Se ha programado una nueva visita asociada a la solicitud <strong>#{{ $visitRequest->id }}</strong>:</p>

    <ul>
        <li><strong>Actividad:</strong> {{ $visitSchedule->activity }}</li>
        <li><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($visitSchedule->date)->format('d/m/Y') }}</li>
        <li><strong>Hora:</strong> {{ $visitSchedule->start_time }} - {{ $visitSchedule->end_time }}</li>
        @if ($visitSchedule->environment)
            <li><strong>Ambiente:</strong> {{ $visitSchedule->environment->name }}</li>
        @endif
        <li><strong>Observaciones:</strong> {{ $visitSchedule->observations ?? '—' }}</li>
    </ul>

    <p style="text-align:center; margin: 16px 0;">
        <a href="{{ $publicUrl }}"
            style="display:inline-block; padding:12px 18px; text-decoration:none; border-radius:6px; background:#2563eb; color:#ffffff; font-weight:600;"
            target="_blank" rel="noopener">
            Ver detalles en SICEFA
        </a>
    </p>

    <p>Si el botón no funciona, copia y pega este enlace en tu navegador:<br>
        <span style="word-break:break-all;">{{ $publicUrl }}</span>
    </p>

    <p>Por favor, verifique la programación y confirme su disponibilidad.</p>

    <p>Atentamente,<br>
        <strong>Equipo SIGAC / SICEFA</strong>
    </p>
</body>

</html>
