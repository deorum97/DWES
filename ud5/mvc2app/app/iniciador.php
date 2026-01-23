<?php
    //Cargamos el autoloader de Composer
    require_once __DIR__.'/../vendor/autoload.php';

    //Cargamos configuracion
    require_once __DIR__.'/../app/config/config.php';

    if (session_status() === PHP_SESSION_NONE) {
        // Si tu app vive en un subdirectorio, esto ayuda a que la cookie de sesión sea consistente.
        // Ajusta el path si tu base cambia.
        session_set_cookie_params(0, '/DWES/ud5/mvc2app/');
        session_start();
    }