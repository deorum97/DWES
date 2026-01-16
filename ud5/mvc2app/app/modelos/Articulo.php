<?php

class Articulo{ 
    private $bd;
    
    public function __construct()
    {
        $this->bd = new Db();

    }

    public function obtenerArticulos(){
        $this->bd->query("SELECT * FROM articulos");
        return $this->bd->registros();
    }

    public function obtenerArticulo($id){
        $this->bd->query("SELECT * FROM articulos WHERE id_articulo = :id");
        $this->bd->bind(':id', $id);
        return $this->bd->registro();
    }
}
