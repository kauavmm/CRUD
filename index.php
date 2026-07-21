<?php 

declare(strict_types=1);

include_once __DIR__ . '/vendor/autoload.php';

use App\Helpers\Session;
use App\Controllers\UserController;

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;

Session::start();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$userController = new UserController();

// Read users
$router->map('GET', '/', [$userController, 'index']);

// Create user
$router->map('GET', '/users/create', [$userController, 'create']);

// Save new user
$router->map('POST', '/users', [$userController, 'store']);

// Edit user
$router->map('GET', '/users/{id}/edit', [$userController, 'edit']);

// Update user
$router->map('POST', '/users/{id}', [$userController, 'update']);

// Delete user
$router->map('GET', '/users/{id}/delete', [$userController, 'destroy']);

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);

?>