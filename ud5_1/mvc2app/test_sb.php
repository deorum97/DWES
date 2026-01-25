<?php

require_once 'app/config/config.php';
require_once 'app/librerias/Db.php';

use App\Librerias\Db;

try {
    echo "Intentando conectar a la base de datos...\n";
    echo "Host: " . DB_HOST . "\n";
    echo "Puerto: " . DB_PORT . "\n";
    echo "Usuario: " . DB_USUARIO . "\n";
    echo "Base de datos: " . DB_NOMBRE . "\n";

    $db = new Db();
    echo "Conexión exitosa!\n";
} catch (Exception $e) {
    echo "Error de conexión: " . $e->getMessage() . "\n";
}
