<?php

namespace App\Helpers;

use League\Plates\Engine;

class Html {
    private static ?Engine $engine = null;

    public static function render(string $template, array $args = []): string { // If $args does not receive any array data, it will be empty 
        return self::getEngine()->render($template, $args);
    }

    public static function getEngine(): Engine {
        if (self::$engine === null) {
            self::$engine = new Engine(__DIR__ . '/../../views/');
        }

        return self::$engine;
    }
}

?>