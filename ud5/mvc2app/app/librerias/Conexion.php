<?php
namespace App\Librerias;

use App\Config\Config;

class Conexion{
    public static function getConexion() : \PDO {
        $config = Config::getInstance();


        $driver = $config->get('database', 'driver');
        $host   = $config->get('database', 'host');
        $dbname = $config->get('database', 'dbname');
        $port   = $config->get('database', 'port');
        $user   = $config->get('database', 'user');
        $pass   = $config->get('database', 'pass');

        // DSN básico
        $dsn = "$driver:host=$host;dbname=$dbname;port=$port";

        // Ajuste especial solo para MySQL
        if ($driver === 'mysql') {
            $dsn .= ";charset=utf8mb4";
        }

        try {
            $pdo = new \PDO($dsn, $user, $pass);
            // Mostramos errores como excepciones (más fácil de depurar)
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}