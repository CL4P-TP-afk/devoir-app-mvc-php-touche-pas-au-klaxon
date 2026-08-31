<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller\AuthController;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Middleware\AuthMiddleware;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller\TripController;
use Buki\Router\Router;

SessionService::start();

$router = new Router();

$router->get('/', function (): void {
    $controller = new \Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller\HomeController();
    $controller->index();
});

$router->get('/login', function (): void {
    $controller = new AuthController();
    $controller->showLogin();
});

$router->post('/login', function (): void {
    $controller = new AuthController();
    $controller->login();
});

$router->get('/logout', function (): void {
    $controller = new AuthController();
    $controller->logout();
});

$router->get('/trips/create', function (): void {
    AuthMiddleware::requireAuthentication();

    $controller = new TripController();
    $controller->create();
});

$router->post('/trips', function (): void {
    AuthMiddleware::requireAuthentication();

    $controller = new TripController();
    $controller->store();
});

$router->get('/trips/:id', function (string $id): void {
    AuthMiddleware::requireAuthentication();

    $controller = new TripController();
    $controller->show((int) $id);
});


$router->run();