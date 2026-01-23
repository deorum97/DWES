<?php
namespace App\Modelos;

use App\Librerias\Conexion;
class Pedido {
    private $codPed;
    private $restaurante;
    private $enviado;
    public function __construct( $restaurante = null, $enviado = '0'){
        $this->restaurante=$restaurante;
    }

    public function guardar()
    {
        $pdo = Conexion::getConexion();
        $sql = "INSERT INTO pedidos (Fecha, Enviado, Restaurante) VALUES (NOW(), 0, :restaurante)";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':restaurante',$this->restaurante);
        $stmnt->execute();

        $this->codPed = $pdo->lastInsertId();
    }
    public function getCodPed() {
        return $this->codPed;
    }
}
