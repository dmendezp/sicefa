<?php
// Definir un diccionario de unidades productivas y sus respectivos íconos
$unitIcons = [
    'Pasteleria' => 'fas fa-birthday-cake fa-lg',
    'Chocolateria' => 'fas fa-mug-hot fa-lg',
    // ... Agregar más unidades y sus íconos aquí
];

// Determinar el ícono correspondiente al nombre de la unidad actual
$currentUnitIcon = $unitIcons[$unit->name] ?? 'fas fa-question-circle fa-lg';
?>