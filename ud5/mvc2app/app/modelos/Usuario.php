<?php
namespace App\Modelos;

use App\Librerias\Conexion;

class Usuario
{
    private $codRes;
    private $correo;
    private $clave;
    private $pais;
    private $cp;
    private $ciudad;
    private $direccion;
    public function __construct($codRes = null, $correo = null, $clave = null, $pais = null, $cp = null, $ciudad = null, $direccion = null){
        $this->codRes=$codRes;
        $this->correo=$correo;
        $this->clave=$clave;
        $this->pais=$pais;
        $this->cp=$cp;
        $this->ciudad=$ciudad;
        $this->direccion=$direccion;
    }

    public static function login($correo, $clave){
        if (empty($correo) || empty($clave)) {
            return false;
        }

        try {
            $pdo = Conexion::getConexion();
            $sql = 'SELECT * FROM restaurantes WHERE Correo = :correo AND Clave = :clave';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':correo' => $correo,
                ':clave' => $clave,
            ]);

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $usuario ?: false;
        } catch (\PDOException $e) {
            throw new \PDOException('Error al validar usuario: '.$e->getMessage());
        }
    }
}