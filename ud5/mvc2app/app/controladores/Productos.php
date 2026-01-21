<?php
namespace App\Controladores;

use App\Librerias\Controlador;

class Productos extends Controlador{
    public function __construct(){
        $this->productoModelo = $this->modelo('Producto');
    }

    public function index($id) {
        $productos = $this->productoModelo->getProductosPorCategoria($id);

        $datos = [
            'titulo' => "Productos",
            'productos' => $productos,
        ];

        $this->vista('paginas/producto', $datos);
    }

    public function producto($id){
        $producto = $this->productoModelo->getProductoPorId($id);
        $datos = [
            'titulo' => "Producto",
            'producto' => [$producto],
        ];

        $this->vista('paginas/producto', $datos);
    }

    public function addCarrito($id){
        $datos = [
            'titulo' => "añadir al carrito",

        ];

        $this->vista('paginas/producto', $datos);
    }

}
