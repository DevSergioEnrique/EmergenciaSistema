<?php
    spl_autoload_register(function ($className) {
        $path = __DIR__ . '\\';
        $className = str_replace('\\', '/', $className);
        $file = $path . strtolower($className) . '.php';

        if (file_exists($file)) {
            require_once $file;
        } else {
            die("Autoloader could not find class $className at $file.");
        }
    });
