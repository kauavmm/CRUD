<?php

namespace App\Config;

use League\Container\Container;
use League\Container\ReflectionContainer;
use PDO;
use PDOException;

$container = new Container();

$container->delegate(new ReflectionContainer()); // Enables automatic resolution via reflection for classes that were not explicitly registered (UserModel, UserController, ...)

$container->add(PDO::class, function () { // Connect to the database
    $host = "mysql";
    $user = "root";
    $password = "root";
    $db = "crud_db";
    $charset = "utf8mb4";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    
    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Connection error " . $e->getMessage();
        die();
    }
})->setShared(true); // Establishes the connection once, saves it in the container and always returns the same connection

return $container;

?>