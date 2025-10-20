<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = "../src/".str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if (file_exists($file)) {
                require $file;
            }
        });
    }
} //naviguer dans les fichiers : ../ revient 1 fichier en arrière
