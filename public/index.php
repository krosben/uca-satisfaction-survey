<?php

require_once __DIR__.'/../vendor/autoload.php';

use Opis\Database\Connection;
use Opis\Database\Database;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;

$connection = new Connection(
    getenv('DB_DSN'),
    getenv('DB_USER'),
    getenv('DB_PASS')
);

$db = new Database($connection);
$loader = new \Twig\Loader\FilesystemLoader('../src/views');
$twig = new \Twig\Environment($loader);
$collector = new RouteCollector();

$collector->get('/', function () use ($twig, $db) {
    $form = [
        'subjects' => $db->from('subjects')->select(['id', 'name', 'id_degree'])->all(),
        'degrees' => $db->from('degrees')->select(['id', 'name'])->all(),
        'groups' => $db->from('groups')->select()->all(),
        'exam' => 6,
        'enrollment' => 6,
        'genders' => $db->from('gender')->select()->all(),
        'mentoring' => $db->from('mentoring')->select()->all(),
        'interest' => $db->from('interest')->select()->all(),
        'expectedgrade' => $db->from('expected_grade')->select()->all(),
        'dificulty' => $db->from('dificulty')->select()->all(),
        'assistance' => $db->from('assistance')->select()->all(),
        'questions' => array_group_by($db->from('questions')->select()->all(), 'type', 'subtype'),
        'proffesors' => $db->from('proffesors')->select()->all(),
        'answers' => ['NS', '1', '2', '3', '4', '5'],
        'columns' => 3,
    ];

    return $twig->render('index.twig', $form);
});

$collector->get('admin', function () use ($twig) {
    return $twig->render('admin.twig');
});

$dispatcher = new Dispatcher($collector->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

echo $response;
