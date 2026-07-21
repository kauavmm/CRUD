<?php declare(strict_types=1);

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use App\Helpers\Session;
use App\Controllers\UserController;

Session::start();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$router->map('GET', '/users', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $userController = new UserController();
    $response->getBody()->write($userController->index());
    return $response;
});

$router->map('GET', '/users/create', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $userController = new UserController();
    $response->getBody()->write($userController->create());
    return $response;
});

$router->map('GET', '/test-route.php', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);