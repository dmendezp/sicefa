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
        @if($visitSchedule->environment)
            <li><strong>Ambiente:</strong> {{ $visitSchedule->environment->name }}</li>
        @endif
        <li><strong>Observaciones:</strong> {{ $visitSchedule->observations ?? '—' }}</li>
    </ul>

    <p>Por favor, verifique la programación y confirme su disponibilidad.</p>

    <p>Atentamente,<br>
    <strong>Equipo SIGAC / SICEFA</strong></p>
</body>
</html>
