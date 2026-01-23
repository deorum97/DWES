<?php
namespace App\Controladores;

use App\Librerias\Controlador;

    class Paginas extends Controlador{

        public function __construct(){
        }

        public function index(){

            $datos = [
                'titulo' => 'ED 23-24',
            ];

            $this->vista('paginas/inicio', $datos);
        }

        public function quienes_somos(){
            $datos = [
                'titulo' => 'Quienes somos',
                'descripcion' => 'Pagina donde se compran productos para restaurantes',
            ];
            $this->vista('paginas/quienes-somos', $datos);
        }
    }