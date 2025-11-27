<?php
    namespace Jrm\EvUd1;
    require '../vendor/autoload.php';

    use Jrm\EvUd1\Conexion;

    class GestorMascotas{
        private \PDO $pdo;

        public function __construct() {
            $this->pdo = Conexion::conectar();
        }

        public function insertar(array $datos):int{
            try{
                $sqlInsert  = "INSERT INTO mascotas(nombre, tipo, fecha_nacimiento, foto_url, id_persona) VALUES (:nombre,:tipo,:fecha_nacimiento,:foto_url,:id_persona)";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                $stmntInsert->execute([
                    ":nombre" => $datos["nombre"],
                    ":tipo" => $datos["tipo"],
                    ":fecha_nacimiento" => $datos["fecha_nacimiento"],
                    ":foto_url" => $datos["foto_url"],
                    ":id_persona" => $datos["id_persona"]
                ]);
                $this->insertarLogSesion(["Mascota añadida"]);
                return (int)$this->pdo->lastInsertid();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al insertar la nueva mascota: ".$datos["nombre"].": ".$e->getMessage());
            }
        }

        public function insertarLog(array $datos)
        {
            try{
                $sqlInsert  = "INSERT INTO logs(accion) VALUES (:accion)";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                $stmntInsert->execute([
                    ":accion" => $datos["accion"]
                ]);
                return (int)$this->pdo->lastInsertid();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al insertar el nuevo log: ".$datos["accion"].": ".$e->getMessage());
            }
        }

        public function eliminar(int $id){
            try{
                $sqlDelete = "DELETE FROM mascotas WHERE id = :id";
                $stmntDelete = $this->pdo->prepare($sqlDelete);
                $stmntDelete->execute([":id" => $id]);
                $this->insertarLogSesion(["Mascota eliminada"]);
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al Elimiar la mascota: ".$e->getMessage());
            }
        }

        public function actualizarFoto (int $id, string $foto_url){
            try{
                $sqlInsert  = "UPDATE mascotas SET foto_url=:foto_url WHERE id = :id";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                $stmntInsert->execute([
                    ":foto_url" => $foto_url,
                    ":id" => $id,
                ]);
                $this->insertarLogSesion(["Actualizada foto de mascota"]);
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al modificar el libro ".$datos["titulo_libro"].": ".$e->getMessage());
            }
        }

        public function getResponsable(int $id){
            try{
                $sqlSelect = $this->pdo->prepare("SELECT nombre FROM personas WHERE id=:id");
                $sqlSelect->execute([
                ":id" => $id
                ]);
                return $sqlSelect->fetch();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar los libos: ".$e->getMessage());
            }
        }

        public function getMascota(int $id){
            try{
                $sqlSelect = $this->pdo->prepare("SELECT * FROM mascotas WHERE id=:id");
                $sqlSelect->execute([
                ":id" => $id
                ]);
                return $sqlSelect->fetch();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar los libos: ".$e->getMessage());
            }
        }

        public function listar():array{
            try{
                $sqlSelect = $this->pdo->query("SELECT * FROM mascotas", \PDO::FETCH_OBJ);
                return $sqlSelect->fetchAll();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar las mascotas: ".$e->getMessage());
            }
        }

        public function listarResponsables():array{
            try{
                $sqlSelect = $this->pdo->query("SELECT * FROM personas", \PDO::FETCH_OBJ);
                return $sqlSelect->fetchAll();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar las personas: ".$e->getMessage());
            }
        }

        public function listarLogs():array{
            try{
                $sqlSelect = $this->pdo->query("SELECT * FROM logs", \PDO::FETCH_OBJ);
                return $sqlSelect->fetchAll();
            }catch(\PDOException $e){
                throw new \RuntimeException("Error al listar los logs: ".$e->getMessage());
            }
        }

        private function insertarLogSesion(array $datos){
            $arrayOr = $_SESSION['array'] ?? array("");
            $arrayRes = array_merge($arrayOr,$datos);
            $_SESSION['array'] = $arrayRes;
        }

        
        private function transaccion(array $datos){
            try{
                $this->pdo->beginTransaction();
                $sqlInsert  = "INSERT INTO mascotas(id,nombre, tipo, fecha_nacimiento, foto_url, id_persona) VALUES (:id,:nombre,:tipo,:fecha_nacimiento,:foto_url,:id_persona)";
                $stmntInsert = $this->pdo->prepare($sqlInsert);
                $stmntInsert->execute([
                    ":id" => $datos["id"],
                    ":nombre" => $datos["nombre"],
                    ":tipo" => $datos["tipo"],
                    ":fecha_nacimiento" => $datos["fecha_nacimiento"],
                    ":foto_url" => $datos["foto_url"],
                    ":id_persona" => $datos["id_persona"]
                ]);
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
