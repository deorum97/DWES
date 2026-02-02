<?php
namespace Jrm\Mvc2app;

use Jrm\Mvc2app\Controlador;
use Jrm\Mvc2app\Db;
use PDO;

class Veterinario{ 
    private $bd;

    private $id;
    private $nombre;
    private $clave;
    private $email;

    public function __construct()
    {
        $this->bd = new Db();
        $this->id = '';
        $this->nombre = '';
        $this->clave = '';
        $this->email= '';
    }

    public function obtenerUsuarios(){
        $this->bd->query("SELECT * FROM veterinarios");
        return $this->bd->registros();
    }

    public function obtenerVeterinario($num_registro){
        $this->bd->query("SELECT * FROM veterinarios WHERE id = :id");
        $this->bd->bind(':id', $num_registro, PDO::PARAM_INT);
        return $this->bd->registro();
    }

    public function loguearVeterinario($nombre, $clave){
        $this->bd->query("SELECT * FROM veterinarios WHERE nombre = :nombre AND clave = :clave");
        $this->bd->bind(':nombre', $nombre);
        $this->bd->bind(':clave', $clave);
        return $this->bd->registro();
    }

    public function create(array $data): bool {
        $this->bd->query(
            "INSERT INTO veterinarios (nombre, clave,email)
         VALUES (:nombre, :clave)"
        );
        $this->bd->bind(':nombre', $data['nombre']);
        $this->bd->bind(':clave', $data['clave']);
        $this->bd->bind(':email', $data['email']);
        return $this->bd->execute();
    }

    public function update(int $id, array $data): bool {
        $this->bd->query(
            "UPDATE veterinarios 
         SET nombre = :nombre, clave = :clave, email = :
         WHERE id = :id"
        );
        $this->bd->bind(':nombre', $data['nombre']);
        $this->bd->bind(':clave', $data['clave']);
        $this->bd->bind(':email', $data['email']);

        $this->bd->bind(':id', $id);
        return $this->bd->execute();
    }

    public function delete(int $id): bool {
        $this->bd->query("DELETE FROM veterinarios WHERE id = :id");
        $this->bd->bind(':id', $id);
        return $this->bd->execute();
    }

}
