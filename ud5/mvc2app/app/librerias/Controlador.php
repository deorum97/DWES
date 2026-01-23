<?php
namespace App\Librerias;

//Clase controlador principal
//Carga los modelos y las vistas.

class Controlador{

    //Cargar modelo
    public function modelo ($modelo){
        //carga
        $claseModelo = 'App\\Modelos\\' . $modelo;
        //Instanciar el modelo
        return new $claseModelo();
    }

    //Cargar vista
    public function vista($vista, $datos = []){
        //Comprobar si existe el archivo de vista.
        if (file_exists('../app/vistas/'.$vista.'.php')){
            extract($datos);
            require_once '../app/vistas/'.$vista.'.php';
        }else{
            //si el archivo de vista no existe
            die('La vista no exite');
        }
    }
}