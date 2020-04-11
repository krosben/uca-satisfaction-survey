<?php

require_once '../vendor/autoload.php';

use App\Application;
use App\Routes;

$app = Application::init();

Routes::init($app);

$app->run();
