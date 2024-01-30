<?php

if (!class_exists('Settings')) {
    class Settings
    {

        public function __construct()
        {

            date_default_timezone_set('America/Sao_Paulo');

            define('DIRECTORY', dirname(dirname(__FILE__) . '/php-basic-structure'));
            define('URL', '');
            define('USER', 'sa');
            define('PASSWORD', 'admin123');
            define('DATABASE', 'DbPrimary');
            define('SERVER', 'ATAR-010');
            define('DRIVER_BD', 'sqlsrv');
        }
    }
    $config = new Settings();
}
