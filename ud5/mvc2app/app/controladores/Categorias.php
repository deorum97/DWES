<?php
namespace App\Controladores;

use App\Librerias\Controlador;
use App\Modelos\Categoria;

class Categorias extends Controlador{
    public function __construct(){
        // echo 'Controlador Artículos cargado';
        $this->categoriaModelo = $this->modelo('Categoria');
    }

    public function index() {
        $categorias = Categoria::getAllCategorias();

        $datos = [
            'titulo' => "Categorias",
            'categorias' => $categorias,
        ];

        $this->vista('paginas/categoria', $datos);
    }

    public function categoria($id){
        $categoria = $this->categoriaModelo->getCategoriaPorId($id);
        $datos = [
            'titulo' => "Categoria",
            'categoria' => [$categoria],
        ];

        $this->vista('paginas/categoria', $datos);
    }

}
