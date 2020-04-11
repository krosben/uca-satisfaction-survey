<?php

namespace App;

class Routes
{
    /**
     * @var \App\Application
     */
    private $app;

    public static function init(Application $app)
    {
        $instance = new self();
        $instance->app = $app;
        $methods = get_class_methods($instance);
        foreach ($methods as $method) {
            if ('init' !== $method) {
                $instance->{$method}();
            }
        }
    }

    public function filterAuth()
    {
        $this->app->router->filter('auth', function () {
            if (!$this->app->session->isUserLoggedIn()) {
                $this->app->redirect('/login');

                return false;
            }
        });
    }

    public function filterLogged()
    {
        $this->app->router->filter('logged', function () {
            if ($this->app->session->isUserLoggedIn()) {
                $this->app->redirect('/dashboard');

                return false;
            }
        });
    }

    public function getBase()
    {
        $this->app->router->get('/', function () {
            return $this->app->twig->render('index.twig', $this->app->getFormData());
        });
    }

    public function getLogout()
    {
        $this->app->router->group(['before' => 'auth'], function ($router) {
            $router->get('/logout', function () {
                $this->app->session->logout();
                $this->app->redirect('/login');
            });
        });
    }

    public function getDashboard()
    {
        $this->app->router->group(['before' => 'auth'], function ($router) {
            $router->get('/dashboard', function () {
                return $this->app->twig->render('dashboard.twig');
            });
        });
    }

    public function getLogin()
    {
        $this->app->router->group(['before' => 'logged'], function ($router) {
            $this->app->router->get('login', function () {
                return $this->app->twig->render('login.twig');
            });
        });
    }

    public function getStatistics()
    {
        $this->app->router->get('/statistics', function () {
            $statistics = new \App\Statistics($this->app->db);

            return $this->app->sendJSON($statistics->resultsByDegrees());
        });
    }

    public function postBase()
    {
        $this->app->router->post('/', function () {
            $validation = $this->app->validator->make($_POST, $this->app->getFormValidationRules());

            $validation->validate();

            if ($validation->fails()) {
                $context = $this->app->getFormData();
                $context['errors'] = $validation->errors()->firstOfAll();
                $context['valid'] = $validation->getValidData();
                $context['invalid'] = $validation->getInvalidData();

                return $this->app->twig->render('index.twig', $context);
            }

            $this->app->savePoll($validation->getValidData());

            return $this->app->twig->render('success.twig');
        });
    }

    public function postLogin()
    {
        $this->app->router->post('login', function () {
            $validation = $this->app->validator->make($_POST, [
                'email' => 'required|email',
                'password' => 'required|login_rule:email',
            ]);
            $validation->validate();

            if ($validation->fails()) {
                $message = 'Email o contraseña incorrectos';

                return $this->app->twig->render('login.twig', ['errors' => $message]);
            }

            $this->app->session->login($validation->getValidData()['email']);

            $this->app->redirect('/dashboard');
        });
    }
}
