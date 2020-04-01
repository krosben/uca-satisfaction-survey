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
    'questions' => [
        'grupo1' => ['Pregunta 1'],
        'grupo2' => [
            'subgrupo1' => [
                'Pregunta 2',
                'Pregunta 3',
                'Pregunta 4',
            ],
            'subgrupo2' => [
                'Pregunta 5',
                'Pregunta 6',
                'Pregunta 7',
                'Pregunta 8',
            ],
            'subgrupo3' => [
                'Pregunta 9',
                'Pregunta 10',
            ],
            'subgrupo4' => [
                'Pregunta 11',
                'Pregunta 12',
                'Pregunta 13',
                'Pregunta 14',
                'Pregunta 15',
                'Pregunta 16',
                'Pregunta 17',
                'Pregunta 18',
                'Pregunta 19',
            ],
            'subgrupo5' => [
                'Pregunta 20',
                'Pregunta 21',
            ],
        ],
        'grupo3' => [
            'Pregunta 22',
            'Pregunta 23',
        ],
    ],
    'answers' => ['NS', '1', '2', '3', '4', '5'],
];

echo $twig->render('index.twig', $form);
