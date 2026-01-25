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

        // Fallback para claves antiguas en texto plano (opcional, depende de si quieres migrar)
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

    public function ampliarColumnaClave(): bool
    {
        try {
            $sql = 'ALTER TABLE restaurantes MODIFY COLUMN Clave VARCHAR(255) NOT NULL';
            $this->db->query($sql)->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function insertar(string $correo, string $clave): bool
    {
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        // Generamos un CodRes único basado en el correo si no tenemos uno
        $codRes = strstr($correo, '@', true) ?: $correo;
        $codRes .= '_' . bin2hex(random_bytes(4));

        $sql = 'INSERT INTO restaurantes (CodRes, Correo, Clave) VALUES (:codres, :correo, :clave)';
        
        try {
            return $this->db->query($sql)
                ->bind(':codres', $codRes)
                ->bind(':correo', $correo)
                ->bind(':clave', $hash)
                ->execute();
        } catch (\Exception $e) {
            // Si falla, intentamos ampliar la columna por si fuera el error de longitud
            $this->ampliarColumnaClave();
            return $this->db->query($sql)
                ->bind(':codres', $codRes)
                ->bind(':correo', $correo)
                ->bind(':clave', $hash)
                ->execute();
        }
    }
}
