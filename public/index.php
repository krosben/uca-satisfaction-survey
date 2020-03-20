<?php

require_once __DIR__.'/../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../src/views');
$twig = new \Twig\Environment($loader);

$form = [
    'asignatura' => ['AS' => 0, 'PCTR' => 1],
    'titulacion' => ['GII' => 2, 'GIA' => 3],
    'grupo' => ['A' => 1, 'B' => 2],
    'exam' => 6,
    'enrollment' => 6,
    'mentoring' => ['Nada', 'Algo', 'Bastante', 'Mucho'],
    'interest' => ['Nada', 'Algo', 'Bastante', 'Mucho'],
    'expectedgrade' => ['N.P.', 'Suspenso', 'Aprobado', 'Notable', 'Sobresaliente', 'M.H.'],
    'dificulty' => ['Baja', 'Media', 'Alta', 'Muy Alta'],
    'assistance' => ['Menos del 50%', 'Entre 50% y 80%', 'Más de 80%'],
];

echo $twig->render('index.twig', $form);
