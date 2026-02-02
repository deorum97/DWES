<?php
namespace Jrm\Mvc2app;

use Jrm\Mvc2app\Controlador;

    class Mascotas extends Controlador{

        public function __construct(){
            $this->modelo = $this->modelo('mascota');
            //echo 'Controlador páginas cargado'.'<br>';
            $this->vista = 'index'; //nombre de la vista por defecto, lo normal es que el servidor la asigne por defecto.
            $this->datos = ['titulo' => 'Mascotas'];

        }

        public function index(){

            $mascotas = $this->modelo->obtenerMascotas();
            $this->datos += [
                'mascotas' => $mascotas,
            ];

            $this->vista('paginas/ejemplo-inicio', $this->datos);
        }
        public function articulo(){
            $this->vista('paginas/articulo');
        }

        public function actualizar($num_registro){
            echo $num_registro;
        }
        

    }