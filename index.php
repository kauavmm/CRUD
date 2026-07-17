<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Helpers\Session;
    use App\Controllers\UserController;

    Session::start();
    
    $userController = new UserController();

    $route = $_GET['route'] ?? 'index';
    $id = $_GET['id'] ?? null;

    match ($route) {
        'index' => $userController->index(),
        'create' => $userController->create(),
        'store' => $userController->store(),
        'edit' => $userController->edit($id),
        'update' => $userController->update($id),
        'destroy' => $userController->destroy($id),
        default => http_response_code(404),
    };
?>