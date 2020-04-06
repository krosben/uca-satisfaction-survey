<?php

require_once '../vendor/autoload.php';

$app = new \App\Application();

$app->router->get('/', function () use ($app) {
    return $app->twig->render('index.twig', $app->getFormData());
});

$app->router->post('/', function () use ($app) {
    $validation = $app->validator->make($_POST, $app->getFormValidationRules());

    $validation->validate();

    if ($validation->fails()) {
        $context = $app->getFormData();
        $context['errors'] = $validation->errors()->firstOfAll();

        return $app->twig->render('index.twig', $context);
    }

    $app->savePoll($validation->getValidData());

    return $app->twig->render('success.twig');
});

$app->router->get('admin', function () use ($app) {
    return $app->twig->render('admin.twig');
});

$app->run();
