<?php

    class Articulos extends Controlador{
        public function __construct(){
            echo 'Controlador Artículos cargado';
            $this->articuloModelo = $this->modelo('Articulo');
        }

        public function index() {
            $articulos = $this->articuloModelo->obtenerArticulos();

            $datos = [
                'titulo' => "Articulos",
                'articulos' => $articulos,
            ];
            
            $this->vista('paginas/articulo', $datos);
        }
        public function articulo($id){
            $articulo = $this->articuloModelo->obtenerArticulo($id);
            $datos = [
                'titulo' => "Articulo",
                'articulos' => [$articulo],
            ];

            $this->vista('paginas/articulo', $datos);
        }

    }
