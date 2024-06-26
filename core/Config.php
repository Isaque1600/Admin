<?php

namespace Core;

abstract class Config
{

    public function __construct()
    {
        ini_set("session.cookie_lifetime", 0);
        ini_set("gc_maxlifetime", 1440);
        error_reporting(E_ALL);

        define('DEFAULT_URL', $_ENV['BASEURL'] . "/");
        define('CSS_PATH', DEFAULT_URL . 'assets/css/');
        define('JS_PATH', DEFAULT_URL . 'assets/js/');
        define('IMG_PATH', DEFAULT_URL . 'assets/images/');

        define("FIRSTKEY", $_ENV['FIRSTKEY']);
        define("SECONDKEY", $_ENV['SECONDKEY']);
        define("THIRDKEY", $_ENV['THIRDKEY']);
    }

}