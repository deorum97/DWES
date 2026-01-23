<?php

namespace App\Modelos;

use App\Librerias\Db;
use App\Librerias\Conexion;

class Producto
{
    private $db;

    private $codProd;
    private $nombre;
    private $descripcion;
    private $precio;
    private $peso;
    private $stock;
    private $categoria;


    public function __construct($codProd = null, $nombre = null, $descripcion = null, $precio = null, $peso = null, $stock = null, $categoria = null)
    {
        $this->db = new Db();
        $this->codProd = $codProd;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->peso = $peso;
        $this->stock = $stock;
        $this->categoria = $categoria;
    }

    public function getAllProductos()
    {
        $this->db->query("SELECT * FROM productos");
        return $this->db->registros();
    }

    public function getProductoPorId(int $codProd)
    {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE CodProd = :codProd";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':codProd',$codProd);
        $stmnt->execute();

        $row = $stmnt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            return new Producto(
                $row['CodProd'],
                $row['Nombre'],
                $row['Descripcion'],
                $row['Peso'],
                $row['Stock'],
                $row['Categoria']
            );
        }

        return null;
    }

    public function getProductosPorCategoria(int $codCat)
    {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE Categoria = :categoria";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':categoria',$codCat);
        $stmnt->execute();

        while ($row = $stmnt->fetch(\PDO::FETCH_ASSOC)) {
            $productos[] = new Producto(
                $row['CodProd'],
                $row['Nombre'],
                $row['Descripcion'],
                $row['Precio'],
                $row['Peso'],
                $row['Stock'],
                $row['Categoria']
            );
        }
        return $productos;
    }

    public function getCodProd() {
        return $this->codProd;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }
    public function getPeso() {
        return $this->peso;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getCategoria(){
        return $this->categoria;
    }
}