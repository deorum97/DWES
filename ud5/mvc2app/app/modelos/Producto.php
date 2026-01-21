<?php

namespace App\Modelos;

use App\Librerias\Db;

class Producto
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getAllProductos()
    {
        $this->db->query("SELECT * FROM productos");
        return $this->db->registros();
    }

    public function getProductoPorId(int $codProd)
    {
        $this->db->query("SELECT * FROM productos WHERE CodProd = :CodProd");
        $this->db->bind(':CodProd', $codProd);
        return $this->db->registro();
    }

    public function getProductosPorCategoria(int $codCat)
    {
        $this->db->query("SELECT * FROM productos WHERE Categoria = :CodCat");
        $this->db->bind(':CodCat', $codCat);
        return $this->db->registros();
    }
}