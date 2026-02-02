<?php
namespace Jrm\Mvc2app;

use Jrm\Mvc2app\Controlador;
use Jrm\Mvc2app\Db;
use PDO;

class Mascota{ 
    private $bd;

    private $id;
    private $nombre;
    private $tipo;
    private $fecha_nacimiento;
    private $foto_url;
    private $id_persona;

    public function __construct()
    {
        $this->bd = new Db();
        $this->id = '';
        $this->nombre = '';
        $this->tipo = '';
        $this->fecha_nacimiento = '';
        $this->foto_url = '';
        $this->id_persona='';
    }

    public function obtenerMascotas(){
        $this->bd->query("SELECT * FROM mascotas");
        return $this->bd->registros();
    }

    public function obtenerMascota($num_registro){
        $this->bd->query("SELECT * FROM mascotas WHERE id = :id");
        $this->bd->bind(':id', $num_registro, PDO::PARAM_INT);
        return $this->bd->registro();
    }

    public function create(array $data): bool {
        $this->bd->query(
            "INSERT INTO mascotas (nombre, tipo, fecha_nacimiento, foto_url, id_pesona)
         VALUES (:nombre, :tipo, :fecha_nacimiento, :foto_url, :id_persona)"
        );
        $this->bd->bind(':nombre', $data['nombre']);
        $this->bd->bind(':tipo', $data['tipo']);
        $this->bd->bind(':fecha_nacimiento', $data['fecha_nacimiento']);
        $this->bd->bind(':foto_url', $data['foto_url']);
        $this->bd->bind(':id_persona', $data['id_persona']);
        return $this->bd->execute();
    }

    public function update(int $id, array $data): bool {
        $this->bd->query(
            "UPDATE mascotas 
         SET nombre = :nombre, tipo = :tipo, fecha_nacimiento = :fecha_nacimiento, foto_url = :foto_url, id_persona = :id_persona
         WHERE id = :id"
        );
        $this->bd->bind(':nombre', $data['nombre']);
        $this->bd->bind(':tipo', $data['tipo']);
        $this->bd->bind(':fecha_nacimiento', $data['fecha_nacimiento']);
        $this->bd->bind(':foto_url', $data['foto_url']);
        $this->bd->bind(':id_persona', $data['id_persona']);
        $this->bd->bind(':id', $id);
        return $this->bd->execute();
    }

    public function delete(int $id): bool {
        $this->bd->query("DELETE FROM mascotas WHERE id = :id");
        $this->bd->bind(':id', $id);
        return $this->bd->execute();
    }

}
