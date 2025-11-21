<?php
    namespace Jrm\Bbdd;
    require '../vendor/autoload.php';

    use Jrm\Bbdd\tools\Conexion;
    use Jrm\Bbdd\Acciones;
    class GestorLectura implements Acciones{
        private \PDO $pdo;

        public function __construct() {
            $this->pdo = Conexion::conectar();
        }

        public function insertar(array $datos):int{
            try{
                $sqlInsert  = "INSERT INTO hobby(id_usuario,titulo_libro, autor, paginas, terminado, fecha_lectura) VALUES (:id_usuario,:titulo_libro,:autor,:paginas,:terminado,:fecha_lectura)";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                $stmntInsert->execute([
                    ":id_usuario" => $datos["id_usuario"],
                    ":titulo_libro" => $datos["titulo_libro"],
                    ":autor" => $datos["autor"],
                    ":paginas" => $datos["paginas"],
                    ":terminado" => $datos["terminado"],
                    ":fecha_lectura" => $datos["fecha_lectura"],
                ]);
                return (int)$this->pdo->lastInsertid();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al insertar el libro ".$datos["titulo_libro"].": ".$e->getMessage());
            }
        }

        public function eliminar(int $id){
            try{
                $sqlDelete = "DELETE FROM hobby WHERE id_libro = :id_libro";
                $stmntDelete = $this->pdo->prepare($sqlDelete);
                $stmntDelete->execute([":id_libro" => $id]);
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al Elimiar el libro: ".$e->getMessage());
            }
        }

        public function actualizar (int $id, array $datos){
            try{
                $sqlInsert  = "UPDATE hobby SET titulo_libro=:titulo_libro,autor=:autor,paginas=:paginas,terminado=:terminado,fecha_lectura=:fecha_lectura WHERE id_libro = :id_libro";
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

        public function getLibro(int $id){
            try{
                $sqlSelect = $this->pdo->query("SELECT * FROM hobby WHERE id_libro=$id", \PDO::FETCH_OBJ);
                return $sqlSelect->fetch();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar los libos: ".$e->getMessage());
            }
        }

        public function listar():array{
            try{
                $sqlSelect = $this->pdo->query("SELECT * FROM hobby", \PDO::FETCH_OBJ);
                return $sqlSelect->fetchAll();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar los libos: ".$e->getMessage());
            }
        }

        private function transaccion(array $datos){
            try{
                $this->pdo->beginTransaction();
                $sqlInsert  = "INSERT INTO hobby(id_usuario,titulo_libro, autor, paginas, terminado, fecha_lectura) VALUES (:id_usuario,:titulo_libro,:autor,:paginas,:terminado,:fecha_lectura)";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                foreach($datos as $libro){
                    $stmntInsert->execute([
                        ":id_usuario" => $_SESSION["id_usuario"],
                        ":titulo_libro" => $libro["titulo_libro"],
                        ":autor" => $libro["autor"],
                        ":paginas" => $libro["paginas"],
                        ":terminado" => $libro["terminado"] ?? 0,
                        ":fecha_lectura" => $libro["fecha_lectura"]?? "2025-11-13",
                    ]);
                }
                $this->pdo->commit();
            }catch(\PDOException $e){
                $this->pdo->rollBack();
                
            }
        }

        public function testTransaccion( array $datos){
            $this->transaccion($datos);
        }
    }
?>
