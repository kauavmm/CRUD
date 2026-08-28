<?php

namespace App\Config;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

// Tell the Doctrine where to look for the Entities, and activate dev mode
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../Entity'], 
    isDevMode: true
);


// Connection data
$connectionParams = [
    'driver' => 'pdo_mysql', // Defines which database we will use
    'host' => 'mysql',
    'user' => 'root',
    'password' => 'root',
    'dbname' => 'crud_db',
    'charset' => 'utf8mb4'
];

$entityManager = new EntityManager(
    DriverManager::getConnection($connectionParams, $config), 
    $config
);

return $entityManager;

?>