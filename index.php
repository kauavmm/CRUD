<?php 

declare(strict_types=1);

include_once __DIR__ . '/vendor/autoload.php';

use App\Helpers\Session;
use App\Controllers\UserController;

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

Session::start();

$container = require __DIR__ . '/src/Config/container.php';

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new Router();

$strategy= new ApplicationStrategy();
$strategy->setContainer($container);

$router->setStrategy($strategy);

// Read users
$router->map('GET', '/', [UserController::class, 'index']);

// Create user
$router->map('GET', '/users/create', [UserController::class, 'create']);

// Save new user
$router->map('POST', '/users', [UserController::class, 'store']);

// Edit user
$router->map('GET', '/users/{id}/edit', [UserController::class, 'edit']);

// Update user
$router->map('POST', '/users/{id}', [UserController::class, 'update']);

// Delete user
$router->map('GET', '/users/{id}/delete', [UserController::class, 'destroy']);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);

?>