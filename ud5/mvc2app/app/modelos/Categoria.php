<?php
namespace App\Modelos;

use App\Librerias\Db;
use App\Librerias\Conexion;

class Categoria {
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getId()
    {
        return $this->codCat;
    }

    public static function getAllCategorias(){
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM categorias";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        $categorias = [];
        while($row = $stmnt->fetch(\PDO::FETCH_ASSOC)){
            $categorias[] = new Categoria($row['CodCat'],$row['Nombre'],$row['Descripcion']);
        }
        return $categorias;
    }

    public function getCategoriaPorId(int $codCat){
        $this->db->query("SELECT * FROM categorias WHERE CodCat = :CodCat");
        $this->db->bind(':CodCat', $codCat);
        return $this->db->registro();
    }
}