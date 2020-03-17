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
];
echo $twig->render('index.twig', $form);
