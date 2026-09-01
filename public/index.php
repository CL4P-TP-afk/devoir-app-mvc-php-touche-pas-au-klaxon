<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Service\SessionService;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller\AuthController;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Middleware\AuthMiddleware;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller\TripController;
use Loic\DevoirAppMvcPhpTouchePasAuKlaxon\Controller\AdminController;
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

$router->get('/trips/:id/edit', function (string $id): void {
    AuthMiddleware::requireAuthentication();

    $controller = new TripController();
    $controller->edit((int) $id);
});

$router->post('/trips/:id', function (string $id): void {
    AuthMiddleware::requireAuthentication();

    $controller = new TripController();
    $controller->update((int) $id);
});

$router->post('/trips/:id/delete', function (string $id): void {
    AuthMiddleware::requireAuthentication();

    $controller = new TripController();
    $controller->delete((int) $id);
});

$router->get('/admin', function (): void {
    AuthMiddleware::requireAdmin();

    $controller = new AdminController();
    $controller->dashboard();
});

$router->get('/admin/agencies/create', function (): void {
    AuthMiddleware::requireAdmin();

    $controller = new AdminController();
    $controller->createAgency();
});

$router->post('/admin/agencies', function (): void {
    AuthMiddleware::requireAdmin();

    $controller = new AdminController();
    $controller->storeAgency();
});

$router->get('/admin/agencies/:id/edit', function (int $id): void {
    AuthMiddleware::requireAdmin();

    $controller = new AdminController();
    $controller->editAgency($id);
});

$router->post('/admin/agencies/:id', function (int $id): void {
    AuthMiddleware::requireAdmin();

    $controller = new AdminController();
    $controller->updateAgency($id);
});

$router->post('/admin/agencies/:id/delete', function (int $id): void {
    AuthMiddleware::requireAdmin();

    $controller = new AdminController();
    $controller->deleteAgency($id);
});

$router->run();