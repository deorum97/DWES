<?php
    namespace Jrm\Apco;
    require '../vendor/autoload.php';

    use Jrm\Apco\Tools\Conexion;
    class Categoria {
        private $codCat;
        private $nombre;
        private $descripcion;

        public function __construct($codCat,$nombre, $descripcion)
        {
            $this->codCat = $codCat;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
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
            while($row = $stmnt->fetch()){
                $categorias[] = new Categoria($row['CodCat'],$row['Nombre'],$row['Descripcion']);
            }
            return $categorias;
        }

        public static function getCategoriaPorId(int $codCat){
            $pdo = Conexion::getConexion();
            $sql = "SELECT * FROM categorias WHERE CodCat = :CodCat";
            $stmnt = $pdo->prepare($sql);
            $stmnt->bindParam(':CodCat',$codCat);
            $stmnt->execute();
            return $stmnt->fetch();
        }
    }