<?php

namespace App;

use Opis\Database\Connection;
use Opis\Database\Database;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;

class Application
{
    /**
     * @var RouteCollector
     */
    public $router;
    /**
     * @var Database
     */
    public $db;
    /**
     * @var \Twig\Environment
     */
    public $twig;
    /**
     * @var Connection
     */
    private Connection $connection;

    public function __construct()
    {
        $this->connection = new Connection(
            getenv('DB_DSN'),
            getenv('DB_USER'),
            getenv('DB_PASS')
        );
        $this->db = new Database($this->connection);
        $this->router = new RouteCollector();
        $loader = new \Twig\Loader\FilesystemLoader('../src/views');
        $this->twig = new \Twig\Environment($loader);
    }

    public function run()
    {
        $dispatcher = new Dispatcher($this->router->getData());

        try {
            $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        } catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $ex) {
            error_log($ex);
            http_response_code(404);
            $response = $this->twig->render('404.twig');
        }
        echo $response;
    }
}
