<?php

require_once '../vendor/autoload.php';

use Josantonius\Session\Session;

$app = \App\Application::withTwig();

$app->router->filter('auth', function () use ($app) {
    if (is_null(Session::get('email'))) {
        $app->redirect('/login');

        return false;
    }
});

$app->router->group(['before' => 'auth'], function ($router) use ($app) {
    $router->get('/logout', function () use ($app) {
        Session::destroy('email');
        $app->redirect('/login');
    });
});

$app->router->filter('logged', function () use ($app) {
    if (!is_null(Session::get('email'))) {
        $app->redirect('/dashboard');

        return false;
    }
});

$app->router->group(['before' => 'auth'], function ($router) use ($app) {
    $router->get('/dashboard', function () use ($app) {
        return $app->twig->render('dashboard.twig');
    });
});

$app->router->get('/statistics', function () use ($app) {
    $statistics = new \App\Statistics($app->db);

    return $app->sendJSON($statistics->resultsByDegrees());
});

$app->router->get('/', function () use ($app) {
    return $app->twig->render('index.twig', $app->getFormData());
});

$app->router->post('/', function () use ($app) {
    $validation = $app->validator->make($_POST, $app->getFormValidationRules());

    $validation->validate();

    if ($validation->fails()) {
        $context = $app->getFormData();
        $context['errors'] = $validation->errors()->firstOfAll();
        $context['valid'] = $validation->getValidData();
        $context['invalid'] = $validation->getInvalidData();

        echo '<pre>';
        print_r($context['errors']);
        echo '</pre>';

        return $app->twig->render('index.twig', $context);
    }

    $app->savePoll($validation->getValidData());

    return $app->twig->render('success.twig');
});

$app->router->group(['before' => 'logged'], function ($router) use ($app) {
    $app->router->get('login', function () use ($app) {
        return $app->twig->render('login.twig');
    });
});

$app->router->post('login', function () use ($app) {
    $validation = $app->validator->make($_POST, [
        'email' => 'required|email',
        'password' => 'required|login_rule:email',
    ]);
    $validation->validate();

    if ($validation->fails()) {
        $message = 'Email o contraseña incorrectos';

        return $app->twig->render('login.twig', ['errors' => $message]);
    }

    Session::set('email', $validation->getValidData()['email']);

    $app->redirect('/dashboard');
});

$app->run();
