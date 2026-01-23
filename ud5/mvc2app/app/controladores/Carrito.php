<?php
namespace App\Controladores;

use App\Librerias\Controlador;

class Carrito extends Controlador{
    public function __construct()
    {

    }

    public function index(){
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        $datos = [
            'titulo' => 'Carrito de Compras',
            'carrito' => $carrito
        ];

        $this->vista('paginas/carrito', $datos);
    }
}