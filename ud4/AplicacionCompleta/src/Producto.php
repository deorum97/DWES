<?php

use Jrm\Apco\Tools\Conexion;
 class Producto {
     private $CodProd;
     private $Nombre;
     private $Descripcion;
     private $Peso;
     private $Stock;
     private $CodCat;

     public function __construct($CodProd, $Nombre, $Descripcion, $Peso, $Stock, $CodCat){
         $this->CodProd=$CodProd;
         $this->Nombre=$Nombre;
         $this->Descripcion=$Descripcion;
         $this->Peso=$Peso;
         $this->Stock=$Stock;
         $this->CodCat=$CodCat;
     }

     public static function getProductosPorCodCat(int $CodCat){
        $pdo = \Jrm\Apco\Tools\Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE CodCat = :CodCat";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':CodCat',$CodCat);
        $stmnt->execute();

        return $stmnt->fetchAll();
     }

 }
