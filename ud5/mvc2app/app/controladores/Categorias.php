<?php
namespace App\Controladores;

use App\Librerias\Controlador;

class Categorias extends Controlador{
    public function __construct(){
        // echo 'Controlador Artículos cargado';
        $this->categoriaModelo = $this->modelo('Categoria');
    }

    private $modelo;

    public function index() {
        $categorias = $this->categoriaModelo->getAllCategorias();

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
