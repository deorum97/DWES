<?php
    namespace jrm\bbdd\tools;

    class Conexion{
        public static function conectar():\PDO{
            $servername = "localhost";
            $username = "root";
            $password = "mysql";
            $database = "trabajo_dwes";
            $cadenaConexion= "mysql:host=$servername;dbname=$database;charset=utf8mb4";

            try {
                $conn = new \PDO($cadenaConexion, $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch(\PDOException $e) {
                throw new \RuntimeException('Error de conexión a la base de datos: ' . $e->getMessage());
            } 
        }
    };
    

