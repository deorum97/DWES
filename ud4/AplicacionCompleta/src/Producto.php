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
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE Categoria = :categoria";
        $stmnt = $pdo->prepare($sql);
        $stmnt->bindParam(':categoria',$categoria);
        $stmnt->execute();

        while ($row = $stmnt->fetch(\PDO::FETCH_ASSOC)) {
            $productos[] = new Producto(
                $row['CodProd'],
                $row['Nombre'],
                $row['Descripcion'],
                $row['Peso'],
                $row['Stock'],
                $row['Categoria']
            );
        }

        return $productos;
    }

    public static function getProductoPorId(string $codProd): ?Producto {
        $pdo = Conexion::getConexion();

        $sql = "SELECT * FROM productos WHERE CodProd = :codProd";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codProd', $codProd);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

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

    public function getCodProd() {
        return $this->codProd;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
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
