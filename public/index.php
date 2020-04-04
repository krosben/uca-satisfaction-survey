<?php

require_once '../vendor/autoload.php';

use Rakit\Validation\Validator;

$app = new \App\Application();

$app->router->get('/', function () use ($app) {
    $form = [
        'subjects' => $app->db->from('subjects')->select(['id', 'name', 'id_degree'])->all(),
        'degrees' => $app->db->from('degrees')->select(['id', 'name'])->all(),
        'groups' => $app->db->from('groups')->select()->all(),
        'exam' => 6,
        'enrollment' => 6,
        'genders' => $app->db->from('gender')->select()->all(),
        'mentoring' => $app->db->from('mentoring')->select()->all(),
        'interest' => $app->db->from('interest')->select()->all(),
        'expectedgrade' => $app->db->from('expected_grade')->select()->all(),
        'dificulty' => $app->db->from('dificulty')->select()->all(),
        'assistance' => $app->db->from('assistance')->select()->all(),
        'questions' => array_group_by($app->db->from('questions')->select()->all(), 'type', 'subtype'),
        'proffesors' => $app->db->from('proffesors')->select()->all(),
        'answers' => ['NS', '1', '2', '3', '4', '5'],
        'columns' => 3,
    ];

    return $app->twig->render('index.twig', $form);
});

$app->router->get('admin', function () use ($app) {
    return $app->twig->render('admin.twig');
});

$app->router->post('submit', function () {
    $validator = new Validator();
    $validation = $validator->make($_POST, [
        'age' => 'required|numeric',
        'lowest-course' => 'required|numeric',
        'highest-course' => 'required|numeric',
        'interest' => 'required|numeric',
        'mentoring' => 'required|numeric',
        'dificulty' => 'required|numeric',
        'expectedgrade' => 'required|numeric',
        'assistance' => 'required|numeric',
    ]);
    $validation->validate();
    print_r($_POST);
});

$app->run();
