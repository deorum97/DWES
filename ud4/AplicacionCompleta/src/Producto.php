<?php
namespace Jrm\Apco;
require '../vendor/autoload.php';
use Jrm\Apco\Tools\Conexion;
 class Producto {
     private $codProd;
     private $nombre;
     private $descripcion;
     private $peso;
     private $stock;
     private $categoria;

     public function __construct($codProd, $nombre, $descripcion, $peso, $stock, $categoria){
         $this->codProd=$codProd;
         $this->nombre=$nombre;
         $this->descripcion=$descripcion;
         $this->peso=$peso;
         $this->stock=$stock;
         $this->categoria=$categoria;
     }

     public static function getProductosPorcategoria(int $categoria){
        $pdo = \Jrm\Apco\Tools\Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE Categoria = :categoria";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':categoria',$categoria);
        $stmnt->execute();

        return $stmnt->fetchAll();
     }

 }
