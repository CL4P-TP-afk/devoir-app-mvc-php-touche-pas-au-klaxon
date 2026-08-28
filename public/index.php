<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use Buki\Router\Router;

$router = new Router();

$router->get('/', function (): void {
    $controller = new \Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller\HomeController();
    $controller->index();
});

$router->run();