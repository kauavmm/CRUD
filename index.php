<?php
    session_start();

    require_once __DIR__ . '/config/database.php';
    require_once __DIR__ . '/model/userModel.php';
    require_once __DIR__ . '/controllers/userController.php';
    
    $pdo = Database::getConnection();
    $userModel = new UserModel($pdo);
    $userController = new UserController($userModel);

    $route = $_GET['route'] ?? 'index';
    $id = $_GET['id'] ?? null;

    match ($route) {
        'index' => $userController->index(),
        'create' => $userController->create(),
        'store' => $userController->store(),
        'edit' => $userController->edit($id),
        'update' => $userController->update($id),
        default => http_response_code(404),
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kauã">
    <title>CRUD</title>
    <link rel="stylesheet" href="views/css/style.css">
</head>
<body>
    
    

</body>
</html>