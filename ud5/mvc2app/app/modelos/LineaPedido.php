<?php
namespace App\Modelos;

use App\Librerias\Conexion;

class LineaPedido{
    private $codPed;
    private $producto;
    private $unidades;

    public function __construct($codPed = null, $producto = null, $unidades = null){
        $this->codPed=$codPed;
        $this->producto=$producto;
        $this->unidades=$unidades;
    }

    public function guardar(){
        $pdo = Conexion::getConexion();
        $sql = "INSERT INTO pedidosproductos VALUES (null, :codPed, :producto, :unidades)";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':codPed',$this->codPed);
        $stmnt->bindParam(':producto',$this->producto);
        $stmnt->bindParam(':unidades',$this->unidades);
        $stmnt->execute();
    }

    public function actualizar(){
        $pdo = Conexion::getConexion();
        $sql = "UPDATE pedidosproductos SET Unidades = :unidades WHERE Pedido = :codPed AND Producto = :producto";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':unidades', $this->unidades);
        $stmnt->bindParam(':codPed', $this->codPed);
        $stmnt->bindParam(':producto', $this->producto);
        $stmnt->execute();
    }
}

