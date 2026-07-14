<?php

class UserModel {
    // The variable will receive a PDO object
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(): array { // The function will return an Array
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // The function will receive an email and check if it exist in the database table
    public function emailExists(string $email): bool { // The function will return an Boolean
        // The COUNT() function return only 0 or 1 because it asks the database table: "Who many rows contain this email?"
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email= ?");
        $stmt->execute([$email]);
        $result = $stmt->fetchColumn(); // The "fetchColumn()" returns an value of the first column of the first row
        return (bool) $result;
    }

    public function create(string $name, string $surname, string $username, string $phone, int $age, string $email, string $password):bool {
        $stmt = $this->db->prepare("INSERT INTO users (name, surname, username, phone, age, email, password) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $surname, $username, $phone, $age, $email, $password]);
    }
}

?>