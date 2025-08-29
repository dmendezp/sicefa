-- Script SQL para crear una actividad extraordinaria de prueba
-- Ejecutar en la base de datos del proyecto

-- Verificar si la tabla existe
SHOW TABLES LIKE 'environment_activity_programs';

-- Insertar una actividad extraordinaria de prueba
INSERT INTO environment_activity_programs (
    environment_id,
    activity_name,
    activity_description,
    date,
    start_time,
    end_time,
    person_id,
    created_at,
    updated_at
) VALUES (
    10, -- ID del ambiente (ajustar según tu base de datos)
    'Reunión de Coordinación',
    'Reunión extraordinaria del equipo de coordinación académica',
    '2025-08-29', -- Fecha del 29 de agosto (la que aparece resaltada en tu imagen)
    '14:00:00',   -- Hora de inicio: 2:00 PM
    '16:00:00',   -- Hora de fin: 4:00 PM
    1,            -- ID de persona (ajustar según tu base de datos)
    NOW(),
    NOW()
);

-- Verificar que se insertó correctamente
SELECT * FROM environment_activity_programs WHERE environment_id = 10;

-- Mostrar todas las actividades extraordinarias
SELECT 
    eap.id,
    eap.activity_name,
    eap.date,
    eap.start_time,
    eap.end_time,
    e.name as environment_name
FROM environment_activity_programs eap
JOIN environments e ON eap.environment_id = e.id
ORDER BY eap.created_at DESC;
