<?php

namespace App\Helpers;

class Html {
    public static function render(string $template, array $args = []): string { // If $args does not receive any array data, it will be empty 
        ob_start(); // Everything between ob_start() and ob_get_clean() will be stored
        extract($args); // It will receive an array: ['variable name' => data].
        require_once __DIR__ . $template; // $template will be the file path.
        return ob_get_clean(); // The ob_get_clean() returns a string and removes the buffer created by ob_start()
    }
}

?>