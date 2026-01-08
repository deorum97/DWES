<?php

use Jrm\Apco\Tools\Conexion;
 class Pedido {
     private $CodPed;
     private $CodRes;
     private $Enviado;
     private $Fecha;
    public function __construct($CodPed, $CodRes, $Enviado, $Fecha){
        $this->CodPed=$CodPed;
        $this->CodRes=$CodRes;
        $this->Enviado=$Enviado;
        $this->Fecha=$Fecha;
    }

    public static function guardar()
    {
        $pdo = Conexion::getConexion();
        $sql = "INSERT INTO pedidos VALUES (null, :Fecha, :Enviado,:CodRes,)";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':CodRes',$restaurCodResante);
        $stmnt->bindParam(':Enviado',$Enviado);
        $stmnt->bindParam(':Fecha',$Fecha);
        $stmnt->execute();
    }
 }
