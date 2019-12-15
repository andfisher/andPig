<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author AJ
 */
// TODO: check include path
//ini_set('include_path', ini_get('include_path'));


$includepaths = [
    '../application/AppClasses/',
];

foreach ($includepaths AS $path) {
    set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__ . DIRECTORY_SEPARATOR . $path));
}

define('APPPATH', __DIR__ . DIRECTORY_SEPARATOR . '../application'.DIRECTORY_SEPARATOR);

# Custom autoloader
spl_autoload_register(function($name) {
    if (file_exists(APPPATH . 'AppClasses' . DIRECTORY_SEPARATOR . $name . '.php')) {
        require_once APPPATH . 'AppClasses' . DIRECTORY_SEPARATOR . $name . '.php';
    }
});
