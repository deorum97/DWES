<?php
namespace App\Modelos;

use App\Librerias\Db;
use App\Librerias\Conexion;

class Categoria {
    private $db;
    private $codCat;
    private $nombre;
    private $descripcion;

    public function __construct($codCat = null, $nombre = null, $descripcion = null)
    {
        $this->db = new Db();
        $this->codCat = $codCat;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }


    public static function getAllCategorias(){
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM categorias";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        $categorias = [];
        while($row = $stmnt->fetch(\PDO::FETCH_ASSOC)){
            $categorias[] = new Categoria($row['CodCat'],
                $row['Nombre'],
                $row['Descripcion']);
        }
        return $categorias;
    }

    public function getCategoriaPorId(int $codCat){
        $this->db->query("SELECT * FROM categorias WHERE CodCat = :CodCat");
        $this->db->bind(':CodCat', $codCat);
        $row = $this->db->registro();
        if ($row) {
            return new Categoria($row->CodCat, $row->Nombre, $row->Descripcion);
        }
        return null;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getId()
    {
        return $this->codCat;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}