<?php

use Jrm\Apco\Tools\Conexion;
 class Pedido {
     private $codPed;
     private $restaurante;
     private $enviado;
     private $fecha;
    public function __construct($codPed, $restaurante, $enviado, $fecha){
        $this->codPed=$codPed;
        $this->restaurante=$restaurante;
        $this->enviado=$enviado;
        $this->fecha=$fecha;
    }

    public static function guardar()
    {
        $pdo = Conexion::getConexion();
        $sql = "INSERT INTO pedidos VALUES (null, :fecha, :enviado,:restaurante,)";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':restaurante',$restaurrestauranteante);
        $stmnt->bindParam(':enviado',$enviado);
        $stmnt->bindParam(':fecha',$fecha);
        $stmnt->execute();
    }
 }
