<?php

require_once '../vendor/autoload.php';

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

$app->router->post('submit', function () use ($app) {
    $validation = $app->validator->make($_POST, [
        'degree' => 'required|numeric',
        'subject' => 'required|numeric',
        'group' => 'required|numeric',
        'age' => 'required|numeric',
        'gender' => 'required|numeric',
        'lowest-course' => 'required|numeric',
        'highest-course' => 'required|numeric',
        'enrollment' => 'required|numeric',
        'exam' => 'required|numeric',
        'interest' => 'required|numeric',
        'mentoring' => 'required|numeric',
        'dificulty' => 'required|numeric',
        'expectedgrade' => 'required|numeric',
        'assistance' => 'required|numeric',
        'proffesors' => 'required|array|min:1|max:3',
        'proffesors.*' => 'required|numeric',
        'answers' => 'required|array|equal:proffesors',
        'answers.*' => 'required|array|min:23|max:23',
    ]);

    $validation->validate();

    if ($validation->fails()) {
        // TODO: Send errors to index
        $errors = $validation->errors();
        echo '<pre>';
        print_r($errors->firstOfAll());
        print_r($_POST);
        echo '</pre>';
        exit;
    }

    $app->savePoll($validation->getValidData());

    return $app->twig->render('success.twig');
});

$app->run();
