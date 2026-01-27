<?php
namespace Jrm\Mvc2app;

use Jrm\Mvc2app\Controlador;
use Jrm\Mvc2app\Db;

class Articulo{ 
    private $bd;

    private $titulo;
    private $id_articulo;

    public function __construct()
    {
        $this->bd = new Db();
        $this->titulo = '';
        $this->id_articulo = '';

    }

    public function obtenerArticulos(){
        $this->bd->query("SELECT * FROM articulos");
        return $this->bd->registros();
    }

    public function obtenerArticulo($num_registro){
        $this->bd->query("SELECT * FROM articulos WHERE id_articulo = :id");
        $this->bd->bind(':id', $num_registro, PDO::PARAM_INT);
        return $this->bd->registro();
    }

}
