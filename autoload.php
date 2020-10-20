<?php

spl_autoload_register(function ($class) {

    $dirs = array('controllers','models');
    $found = false;

    foreach ($dirs as $dir){

        $fileName = __DIR__ . '/' . $dir . '/' . $class . '.php';
        if (is_file($fileName)) {
            require_once($fileName);
            $found = true;
        }
    }
    if (!$found) {
        throw new Exception('Unable to load ' . $class);
    }
    return true;
});