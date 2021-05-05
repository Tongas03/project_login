<?php

class Autoloader
{
    public function register($className)
    {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        $fullpath = __DIR__ . '/' . $file;

        if (file_exists($fullpath)) {

            spl_autoload_register(function($file){

                require $file . '.php';

            });

            return true;

        } else {

            return false;
        }
    }
    
}

