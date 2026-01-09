<?php
namespace Mrs\Restaurante;

require_once __DIR__ . '/../vendor/autoload.php';

use Mrs\tools\Conexion;
use PDO;

class GestorCategorias
{
    private static ?PDO $pdo = null;

    private static function pdo(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = Conexion::getConexion();
        }
        return self::$pdo;
    }


    public static function getCategorias(): array
    {
        $sql = "SELECT CodCat, Nombre, Descripcion FROM categorias ORDER BY Nombre";
        return self::pdo()->query($sql)->fetchAll();
    }

}