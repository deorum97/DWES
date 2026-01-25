<?php
declare(strict_types=1);

namespace App\Modelos;

use App\Librerias\Db;

class CategoriaModelo
{
    private Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function obtenerCategorias(): array
    {
        return $this->db->query('SELECT CodCat, Nombre, Descripcion FROM categorias ORDER BY Nombre')->registros();
    }

    public function obtenerCategoria(string $codCat): array|false
    {
        return $this->db->query('SELECT CodCat, Nombre, Descripcion FROM categorias WHERE CodCat = :id LIMIT 1')
            ->bind(':id', $codCat)
            ->registro();
    }
}
