<?php
declare(strict_types=1);

namespace App\Modelos;

use App\Librerias\Db;

class RestauranteModelo
{
    private Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function obtenerPorCredenciales(string $correo, string $clave): array|false
    {
        $sql = 'SELECT CodRes, Correo, Clave FROM restaurantes WHERE Correo = :c LIMIT 1';
        $rest = $this->db->query($sql)
            ->bind(':c', $correo)
            ->registro();

        if ($rest && password_verify($clave, $rest['Clave'])) {
            return $rest;
        }

        // Linea para las que no estas hasehadas o como se diga para que se pueda entrar a la base de datos
        if ($rest && $rest['Clave'] === $clave) {
             return $rest;
        }

        return false;
    }

    public function existeCorreo(string $correo): bool
    {
        $sql = 'SELECT 1 FROM restaurantes WHERE Correo = :c LIMIT 1';
        $res = $this->db->query($sql)->bind(':c', $correo)->registro();
        return $res !== false;
    }

    public function obtenerPorCorreo(string $correo): array|false
    {
        $sql = 'SELECT CodRes, Correo FROM restaurantes WHERE Correo = :c LIMIT 1';
        return $this->db->query($sql)->bind(':c', $correo)->registro();
    }

    public function existeCodRes(string $codRes): bool
    {
        $sql = 'SELECT 1 FROM restaurantes WHERE CodRes = :cod LIMIT 1';
        $res = $this->db->query($sql)->bind(':cod', $codRes)->registro();
        return $res !== false;
    }

    public function actualizarClave(string $codRes, string $nuevaClave): bool
    {
        $hash = password_hash($nuevaClave, PASSWORD_DEFAULT);
        $sql = 'UPDATE restaurantes SET Clave = :clave WHERE CodRes = :cod';
        return $this->db->query($sql)
            ->bind(':clave', $hash)
            ->bind(':cod', $codRes)
            ->execute();
    }

    public function insertar(string $correo, string $clave): bool
    {
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        // Se genera un codigo para el restaurante para poder añadirlo corectamente a la base de datos
        $codRes = strstr($correo, '@', true) ?: $correo;
        $codRes .= '_' . bin2hex(random_bytes(4));

        $sql = 'INSERT INTO restaurantes (CodRes, Correo, Clave) VALUES (:codres, :correo, :clave)';
        
        return $this->db->query($sql)
            ->bind(':codres', $codRes)
            ->bind(':correo', $correo)
            ->bind(':clave', $hash)
            ->execute();
    }
}
