<?php

namespace App\Helpers;

class Session {
    public static function start() {
        return session_start();
    }

    // Save a value to the session. The 'mixed' type can accept anything (int, string, array, bool, float, ...)
    public static function set(string $key, mixed $value): void {
        $_SESSION[$key] = $value;
    }

    // Read the value of session and if not exists return $default
    public static function get(string $key, mixed $default = null): mixed { // It will return any type
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            return $message;
        } else {
            return $default;
        }
    }

    // Check if there is any value
    public static function has(string $key): bool {
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }

    // Remove a session key
    public static function remove(string $key): void {
        unset($_SESSION[$key]);
        return;
    }

    // Read and delete the value
    public static function flash(string $key): mixed {
        if (isset($_SESSION[$key])) {
            $message = self::get($key);
            self::remove($key);
            return $message;
        } else {
            return null;
        }
    }

    // Prints the flash message for the given key, if one exists
    public static function flashOutput(string $key): void {
        $flashOutput = self::flash($key);
        if ($flashOutput && is_string($flashOutput)) { 
            echo $flashOutput;
        }
    }
}

?>