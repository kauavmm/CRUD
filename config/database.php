<?php

// Connect to database
class Database {
    // The variable will be null or PDO object
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO { // With ": PDO", the function must return a PDO object
        // "self::$pdo" is used because the variale is static
        if (self::$pdo === null) {
            $host = "mysql";
            $user = "root";
            $password = "root";
            $db = "crud_db";
            $charset = "utf8mb4";

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            try {
                self::$pdo = new PDO($dsn, $user, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection error " . $e->getMessage();
                die();
            }
        }

        // Return the static variable
        return self::$pdo;
    }
}

?>