<?php 

declare(strict_types=1);

include_once __DIR__ . '/vendor/autoload.php';

use App\Helpers\Session;
use League\Route\Router;
use Laminas\Diactoros\ServerRequestFactory;
use League\Route\Strategy\ApplicationStrategy;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

Session::start();

$container = require __DIR__ . '/src/Config/container.php';
$defineRoutes = require __DIR__ . '/src/routes.php';

$router = new Router();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$strategy = new ApplicationStrategy();
$strategy->setContainer($container);
$router->setStrategy($strategy);

$defineRoutes($router);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);

?>