<?php
    require __DIR__ . '/vendor/autoload.php';

    use Jrm\bbdd\tools\Conexion;
    class GestorLectura{
        private \PDO $pdo;

        public function __construct() {
            $this->pdo = Conexion::conectar();
        }

        function insertar(array $datos){
            try{
                $sqlInsert  = "INSERT INTO 'hobby'('ID_usuario','titulo_libro', 'autor', 'paginas', 'terminado', 'fecha_lecura') VALUES (:id_usuario,:titulo_libro,:autor,:paginas,:terminado,:fecha_lectura)";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                $stmntInsert->execute([
                    ":id_usuario" => $datos["id_usuario"],
                    ":titulo_libro" => $datos["titulo_libro"],
                    ":autor" => $datos["autor"],
                    ":paginas" => $datos["paginas"],
                    ":terminado" => $datos["terminado"],
                    ":fecha_lectura" => $datos["fecha_lectura"],
                ]);
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al insertar el libro ".$datos["titulo_libro"].": ".$e->getMessage());
            }
        }

        function eliminar(int $id){
            try{
                $sqlDelete = "DELETE FROM 'hobby' WHERE 'ID_libro' = :id_libro";
                $stmntDelete = $this->pdo->prepare($sqlDelete);
                $stmntDelete->execute([":id_libro" => $id]);
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al Elimiar el libro: ".$e->getMessage());
            }
        }

        function actualizar (int $id, array $datos){
            try{
                $sqlInsert  = "UPDATE `hobby` SET `titulo_libro`=':titulo_libro',`autor`=':autor',`paginas`=':paginas',`terminado`=':terminado',`fecha_lectura`=':fecha_lectura' WHERE ID_libro = :id_libro";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                $stmntInsert->execute([
                    ":titulo_libro" => $datos["titulo_libro"],
                    ":autor" => $datos["autor"],
                    ":paginas" => $datos["paginas"],
                    ":terminado" => $datos["terminado"],
                    ":fecha_lectura" => $datos["fecha_lectura"],
                    ":id_libro" => $id,
                ]);
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al modificar el libro ".$datos["titulo_libro"].": ".$e->getMessage());
            }
        }

        function listar():array{
            try{
                $sqlSelect = $this->pdo->query("SELECT * FROM 'hobby'", PDO::FETCH_OBJ);
                return $sqlSelect->fetchAll();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar los libos: ".$e->getMessage());
            }
        }
    }
?>
