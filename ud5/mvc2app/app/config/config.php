<?php

namespace App\Config;

// Configuracion de acceso a la base de datos
//define('DB_HOST', 'localhost');
//define('DB_USUARIO', 'root');
//define('DB_PASSWORD', '');
//define('DB_NOMBRE', 'test');

// Ruta de la aplicacion
define('RUTA_APP', dirname(dirname(__FILE__)));

// Ruta url Ej: http://localhost/ud5/mvc2app/
define('RUTA_URL', 'http://localhost/daw/DWES/ud5/mvc2app');

define('NOMBRESITIO', 'MVC2 APP');

/**
 * Vamos a usar un patrón Singleton para que solo haya una instancia del objeto "Config"
 * Y se use en toda la aplicación.
 *
 * El patrón Singleton se usa para que una clase solo pueda tener una única instancia.
 * Esa instancia se crea la primera vez que se pide.
 * Las siguientes veces se devuelve la misma.
 * El constructor es privado para evitar nuevas instancias.
 * Se accede mediante un método estático llamado getInstance().
 */
class Config
{
    private static $instancia = null;  // Aquí guardamos el único objeto

    private $data = []; // Guardará la configuración

    private function __construct()
    {
        // Cargamos el archivo .ini solo una vez y con secciones 'true'
        $this->data = parse_ini_file(__DIR__ . '/../config/config.ini', true);
    }

    public static function getInstance()
    {
        // Si no existe la instancia, la creamos
        if (self::$instancia === null) {
            self::$instancia = new Config();
        }

        // Devolvemos siempre la misma instancia
        return self::$instancia;
    }

    public function get($section, $key)
    {
        return $this->data[$section][$key];
    }
}