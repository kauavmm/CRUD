<?php
    require_once __DIR__ . '/helpers/session.php';
    Session::start();

    require_once __DIR__ . '/helpers/html.php';
    require_once __DIR__ . '/model/userModel.php';
    require_once __DIR__ . '/controllers/userController.php';
    
    $userModel = new UserModel();
    $userController = new UserController($userModel);

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