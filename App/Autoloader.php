<?php

namespace App;

class AutoLoader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__,'autoLoad'));
    }

    static function autoLoad($class)
    {
        if (strpos($class,__NAMESPACE__ . '\\') === 0){ // pour gérer uniquement ce namespace
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class); // pour les systèmes unix uniquement
            require __DIR__ . '/' . $class . '.php';
        }
    }
}