<?php
namespace Jrm\Mvc2app;

use Jrm\Mvc2app\Controlador;

    class Paginas extends Controlador{

        public function __construct(){

        }

        public function index(){

            $datos = [
                'titulo' => NOMBRESITIO,
            ];

            $this->vista('paginas/inicio', $datos);    
        }


    }