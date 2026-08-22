<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class UserModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll(): array { // The function will return an Array
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // The "fetchAll()" return multiple rows and an array of arrays
    }

    public function count(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM users");
        return (int) $stmt->fetchColumn();
    }

    // The function will receive an email and check if it exist in the database table
    public function emailExists(string $email, ?string $id = null): bool { // The function will return an Boolean
        if ($id === null) { // If the id is null, the query checks only the email
            // The COUNT() function return only 0 or 1 because it asks the database table: "Who many rows contain this email?"
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetchColumn(); // The "fetchColumn()" returns an value of the first column of the first row
            return (bool) $result;
        } else { // If id is not null, the query checks for the email where the id is different from the $id
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND id != ?");
            $stmt->execute([$email, $id]);
            $result = $stmt->fetchColumn();
            return (bool) $result;
        }      
    }

    public function create(string $name, string $surname, string $username, string $phone, int $age, string $email, string $password): bool {
        $stmt = $this->db->prepare("INSERT INTO users (name, surname, username, phone, age, email, password) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $surname, $username, $phone, $age, $email, $password]);
    }

    public function find(string $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // The "fetch()" return only one row
        // Returns true if an array is received or null if the function does not find any user with that id
        return $result ?: null; // "condition ? value if true : value if false"
    }

    public function update(string $id, string $name, string $surname, string $username, string $phone, int $age, string $email, ?string $password = null): bool {
        if (empty($password)) {
            $stmt = $this->db->prepare("UPDATE users SET name = ?, surname = ?, username = ?, phone = ?, age = ?, email = ?
                                        WHERE id = ?");
            return $stmt->execute([$name, $surname, $username, $phone, $age, $email, $id]);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET name = ?, surname = ?, username = ?, phone = ?, age = ?, email = ?, password = ?
                                        WHERE id = ?");
            return $stmt->execute([$name, $surname, $username, $phone, $age, $email, $hashedPassword, $id]);
        }
    }

    public function delete(string $id): bool {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>