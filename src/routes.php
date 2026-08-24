<?php

use App\Controllers\UserController;
use League\Route\Router;

return function (Router $router) {
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

    // Delete users
    $router->map('GET', '/users/{id}/delete', [UserController::class, 'destroy']);
}

?>